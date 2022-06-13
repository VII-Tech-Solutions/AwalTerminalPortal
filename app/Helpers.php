<?php

namespace App;

use App\constants\Attributes;
use App\Constants\FileType;
use App\Models\Attachment;
use App\Models\User;
use Carbon\Carbon;
use Cassandra\Type\UserType;
use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use OpenApi\Annotations\MediaType;
use Sentry\State\Scope;
use Throwable;
use VIITech\Helpers\Constants\DebuggerLevels;
use VIITech\Helpers\GlobalHelpers;
use Webpatser\Uuid\Uuid;
use function Sentry\captureException;
use function Sentry\configureScope;

/**
 * Helpers
 */
class Helpers
{

    /**
     * Returns Formatted JSON Response (returnResponse version 2)
     * @param string $message
     * @param array $data
     * @param array $error
     * @param int $status
     * @param array $headers
     * @return JsonResponse
     */
    public static function formattedJSONResponse($message = '', $data = [], $error = [], $status = Response::HTTP_OK, $headers = [])
    {
        if (is_null($data)) {
            $data = [];
        }
        if (is_null($error)) {
            $error = [];
        }

        return response()->json([
            \VIITech\Helpers\Constants\Attributes::MESSAGE => $message,
            Attributes::DATA => $data,
            Attributes::ERROR => $error,
        ], $status, $headers);
    }

    /**
     * Default Migration
     * @param Blueprint $table
     * @param int $default_status
     * @return void
     */
    static function defaultMigration(Blueprint $table, int $default_status = Status::ACTIVE){
        $table->bigIncrements(Attributes::ID);
        $table->integer(Attributes::STATUS)->default($default_status);
        $table->timestamps();
        $table->softDeletes();
    }

    /**
     * Is Valid Object
     * @param $var
     * @param null $type instance of this type
     * @return boolean
     */
    public static function isValidObject($var, $type = null)
    {
        if (!is_null($var)) { // variable is not null
            if (!is_null($type)) { // check instance type
                return $var instanceof $type || is_a($var, $type); // is variable instance of type
            } else { // variable is not null, don't check type
                return true;
            }
        } else { // variable is null
            return false;
        }
    }

    /**
     *  Is Admin
     * @return bool
     */
    static function isAdmin(){
        /** @var User $user */
        $user = backpack_user();
        if(!is_null($user) && $user->user_type == UserType::EMPLOYEE){
            return true;
        }
        return false;
    }

    static function isFromGoogle($user)
    {
        if(!is_null($user)) {
            if ($user instanceof User) {
                if ($user->provider_type == ProviderType::GOOGLE) {
                    return true;
                }
            }
        }
            return false;
    }

    /**
     * Generate Random Code
     * @param $length
     * @return string
     */
    static function generateCode($length = 9) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Formatted Price
     * @param $price
     * @param string $format
     * @return string
     */
    static function formattedPrice($price, $format = '%0.1f'){
        return sprintf($format, $price);
    }

    /**
     * Nullable Collection
     * @param $collection
     * @return Collection
     */
    static function nullableCollection($collection): Collection
    {
        if(is_null($collection)){
            return collect();
        }
        return $collection;
    }

    /**
     * Capture Exception
     * @param $exception
     */
    static function captureException($exception){
        if(GlobalHelpers::isDevelopmentEnv()){
            dd($exception);
        }
        $level = DebuggerLevels::INFO;
        if (!is_null($exception) && is_a($exception, Throwable::class)) {
            if (env("SENTRY_ENABLED", false)) {
                $user_id = self::resolveUserID();
                if(!is_null($user_id)){
                    configureScope(function (Scope $scope) use($user_id): void {
                        $scope->setUser([Attributes::USER_ID => $user_id]);
                    });
                }
                captureException($exception);
            }
            $level = DebuggerLevels::ERROR;
        }
        GlobalHelpers::debugger($exception, $level);
    }

    /**
     * Get The Latest Only In Collection
     * @param $collection
     * @param $last_update
     * @return mixed
     */
    static function getLatestOnlyInCollection($collection, $last_update){
        return $collection->filter(function($item) use($last_update){
            if(is_null($last_update)){
                return is_null($item->deleted_at);
            }else{
                return Carbon::parse($item->updated_at)->greaterThanOrEqualTo($last_update);
            }
        });
    }

    /**
     * Return Response
     * @param $data
     * @return JsonResponse
     */
    static function returnResponse($data): JsonResponse
    {
        return response()->json([
            Attributes::DATA => $data,
        ]);
    }

    /**
     * Resolve User
     * @return User
     */
    static function resolveUser(){
        try {
            $user =  resolve(Attributes::USER);
            if(is_null($user)){
                $user = Auth::guard("api")->user();
            }
            if(is_null($user)){
                $user = Auth::guard("web")->user();
            }
            return $user;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Resolve User ID
     * @return string
     */
    static function resolveUserID(){
        try {
            $user_id = resolve(Attributes::USER_ID);
            if(is_null($user_id)){
                $user = self::resolveUser();
                if(!is_null($user)){
                    $user_id = $user->id;
                }
            }
            return $user_id;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Readable Text
     * @param $text
     * @return string
     */
    static function readableText($text){
        return ucwords(strtolower(str_replace("_", " ", $text)));
    }

    /**
     * Validate Value in Collection
     * @param $collection
     * @param $new_collection
     * @param $field
     * @return void
     */
    public static function validateValueInCollection(&$collection, &$new_collection, $field){
        $value = $collection->get($field);
        if(!is_null($value)){
            $new_collection->put($field, $value);
        }
    }

    /**
     * Upload File
     * @param $static
     * @param $image
     * @param $attribute_name
     * @param $destination_path
     * @param bool $return_path
     * @param bool $add_to_media
     * @return string|null
     */
    public static function uploadFile($static, $image, $attribute_name, $destination_path, $return_path = true, $add_to_media = true, $generate_name = true, $session_id = null)
    {


        $disk = "public";

        // if a base64 was sent, store it in the db
        if (Str::startsWith($image, 'data:image') || is_a($image, UploadedFile::class) || is_a($image, \Intervention\Image\Image::class)) {

            $allowed_types = ["jpg", "jpeg", "png", "pdf"];

            $extension = 'jpg';
            if (is_a($image, UploadedFile::class)) {
                $extension = $image->extension();
            } else if (is_a($image, \Intervention\Image\Image::class)) {
                $extension = $image->extension;
            }else if(Str::contains($image, "data:image/png;base64")){
                $extension = "png";
            }
            if (!in_array($extension, $allowed_types)) {
                return null;
            }

            // 0. Make the image
            // 1. Generate a filename.
            if (!is_a($image, \Intervention\Image\Image::class) && $generate_name) {
                $image = Image::make($image)->encode($extension, 90);
                $filename = $image->filename;
                if(empty($filename)){
                    $filename = Str::random();
                }
                $filename = $filename . ".$extension";
            } else {
                $filename = $image->getClientOriginalName();
                $image = Image::make($image)->encode($extension, 90);
            }

            // 2. Store the image on disk.
            $stored = Storage::disk($disk)->put($destination_path . '/' . $filename, $image->stream(), 'public');

            // 3. Delete the previous image, if there was one.
            if (!is_null($static) && !is_null($attribute_name)) {
                Storage::disk($disk)->delete($static->{$attribute_name});
            }

            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it
            // from the root folder; that way, what gets saved in the db
            // is the public URL (everything that comes after the domain name)
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);

            /** @var Attachment $attachment */
            if ($add_to_media) {
                $attachment = Attachment::findOrCreate($filename, 1, "$public_destination_path/$filename", $extension, $session_id);
            }

            if ($return_path) {
                return "$public_destination_path/$filename";
            }

            return $attachment;

        }

        if ($return_path) {
            return $image;
        }

        return Attachment::where(Attributes::URL, $image)->first();
    }

    /**
     * Readable Boolean
     * @param boolean $boolean
     * @return string
     */
    public static function readableBoolean($boolean)
    {
        if($boolean === true || $boolean === 1){
            return "Yes";
        } else{
            return "No";
        }
    }

    /**
     * Get Related benefits
     * @param $paginator
     * @param bool $pluck_id
     * @return Collection
     */
    static function getRelatedBenefits($paginator, $pluck_id = false)
    {
        if (is_a($paginator, LengthAwarePaginator::class)) {
            $benefits = collect($paginator->items())->map->benefits;
        } else if (is_a($paginator, Benefit::class)) {
            $benefits = $paginator->items->map->benefits();
        }else if(is_a($paginator, \Illuminate\Database\Eloquent\Collection::class) || is_a($paginator, Collection::class)){
            $benefits = $paginator->map->benefits;
        }
        if(!isset($benefits)){
            return collect();
        }
        $benefits = $benefits->flatten()->unique(Attributes::ID);
        if ($pluck_id) {
            return $benefits->pluck(Attributes::ID);
        }
        return $benefits;
    }

    /**
     * To Custom Array
     * @return array
     */
    static function toCustomArray($collection , $value_name){
        $collect = collect();
        foreach ($collection as $value){
            $collect->add(
                $value['id'] = $value[$value_name]
            );
        }
        return $collect->toArray();
    }

    /**
     * Clear Cache
     * @param string $model
     */
    static public function clearCache($model)
    {
        try {
            Artisan::call("cache:clear");
            Artisan::call("view:clear");
            Artisan::call("modelCache:clear", ["model" => "\\" . addslashes($model)]);
        } catch (Exception $e) {
            GlobalHelpers::debugger($e, DebuggerLevels::ERROR);
        }
    }

    /**
     * Store File
     * @param $id
     * @param $directory
     * @param $file_name
     * @param $output
     * @param bool $overwrite
     * @return string
     */
    static function storeFile($id, $directory, $filename, $output, $overwrite = false)
    {
        $disk_name = 'public';
        $allowed_types = ["jpg", "jpeg", "png", "pdf"];

        $extension = 'pdf';

        if (!in_array($extension, $allowed_types)) {
            return null;
        }

        if (is_null($filename)) {
            $image_file_name = str_replace("-", "", Uuid::generate(1));
            $filename = $image_file_name . ".$extension";
        }else{
            $filename = $filename . ".$extension";
        }

        $path = $directory . '/' . $filename;
        $exists = Storage::disk($disk_name)->exists($path);

        if ($overwrite || !$exists) {
            $exists = Storage::disk($disk_name)->put(null, $output);
        }

        if ($exists) {
            return $filename;
        }
        return null;


    }


    /**
     * Allowed Admin Users
     * @param $allow_type
     * @return bool
     */
    public static function allowedAdminUsers($allow_type){
        /** @var User $user */
        $user = backpack_auth()->user();
        if(is_null($user)){
            return false;
        }
        $user_type = $user->user_type;
        if(!GlobalHelpers::isValidVariable($user_type)){
            return false;
        }
        if(!is_array($allow_type) && $user_type == $allow_type){
            return true;
        }else if(is_array($allow_type) && in_array($user_type, $allow_type)){
            return true;
        }
        return false;
    }
}
