<?php

namespace App\Http\Controllers\Admin;

use App\constants\Attributes;
use App\constants\FieldTypes;
use App\Constants\FlightClasses;
use App\Constants\PassengerTitles;
use App\constants\Status;
use App\constants\Values;
use App\Helpers;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Prologue\Alerts\Facades\Alert;

/**
 * Class CustomCrudController
 * @package App\Http\Controllers\Admin
 */
class CustomCrudController extends CrudController
{

    use ListOperation, CreateOperation, UpdateOperation, DeleteOperation, FetchOperation, InlineCreateOperation;

    /*
    |--------------------------------------------------------------------------
    | FILTERS
    |--------------------------------------------------------------------------
    */

    /**
     * Add Status Filter
     * @param array|null $statuses
     * @param string $column_name
     * @param string $label
     */
    function addStatusFilter($statuses = null, $column_name = null, $label = null)
    {
        if (is_null($statuses)) {
            $statuses = Status::all();
        }
        if (is_null($column_name)) {
            $column_name = Attributes::STATUS;
        }
        if (is_null($label)) {
            $label = "Status";
        }
        $this->crud->addFilter([
            Attributes::TYPE => FieldTypes::DROPDOWN,
            Attributes::NAME => $column_name,
            Attributes::LABEL => $label
        ], $statuses, function ($value) use ($column_name) {
            $this->crud->addClause('where', $column_name, $value);
        });
    }

    /**
     *  Add Passenger Repeatable Field
     */
    public function addPassengerRepeatable()
    {
        CRUD::addField([   // repeatable
            'name' => Attributes::PASSENGER,
            'label' => 'Passenger',
            'type' => 'repeatable',
            'fields' => [
                [
                    Attributes::NAME => Attributes::PASSENGER_TITLE,
                    Attributes::LABEL => 'Title',
                    Attributes::TYPE => FieldTypes::SELECT2_FROM_ARRAY,
                    Attributes::OPTIONS => PassengerTitles::all(),
                ],
                [
                    Attributes::NAME => Attributes::PASSENGER_FIRST_NAME,
                    Attributes::LABEL => 'First Name'
                ],
                [
                    Attributes::NAME => Attributes::PASSENGER_LAST_NAME,
                    Attributes::LABEL => 'Last Name'
                ],
                [
                    Attributes::NAME => Attributes::DOB,
                    Attributes::LABEL => 'Date of birth'
                ],
                [
                    Attributes::NAME => Attributes::FLIGHT_CLASS,
                    Attributes::LABEL => 'Class',
                    Attributes::TYPE => FieldTypes::SELECT2_FROM_ARRAY,
                    Attributes::OPTIONS => FlightClasses::all(),
                ],
                [
                    Attributes::NAME => Attributes::COUNTRY,
                    Attributes::LABEL => 'Nationality'
                ]
            ],

            // optional
            'new_item_label' => 'Add Group', // customize the text of the button
            'init_rows' => 1, // number of empty rows to be initialized, by default 1
        ]);
    }

    function recordActivity($response, $userOriginal = null, $id = null, $model = null, $action = null)
    {
        if (is_null($action)) {
            $action = $this->crud->getActionMethod();
        }
        if (is_null($model)) {
            $model = $this->crud->getModel();
        }
        if ($action != 'destroy') {
            $request = $response->getRequest();
        }
        $changes = [];
        if ($userOriginal instanceof $model) {
            $new = $model::find($request->id);
            foreach ($new->getAttributes() as $key => $value) {
                if ($new->$key != $userOriginal->$key) {
                    if ($key != 'updated_at') {
                        $changes[$key] = $value;
                    }
                }
            }
        }
        $message = null;
        if ($action == 'update') {
            $message = backpack_user()->name . " " . $action . " The Record From Table [" . $this->crud->getModel()->getTable() . "] with id " . $request->id;
            if (!empty($changes)) {
                $message = $message . " Changes ";
                foreach ($changes as $key => $value) {
                    $message = $message . " " . $key . " to " . $value . " ";
                }
            }
        } elseif ($action == 'store') {
            $message = backpack_user()->name . " Added New " . $this->crud->getModel()->getTable();
        } elseif ($action == 'destroy') {
            $message = backpack_user()->name . " Deleted a record from table [" . $this->crud->getModel()->getTable() . "] with id: " . $id;
        }
        Activity::create([
            Attributes::USER_ID => backpack_user()->id,
            Attributes::DESCRIPTION => $message,
        ]);
        return Http::post('https://discord.com/api/webhooks/956452346571927573/qe3QaH52PATyGiWFqbqhi_dhevTDIb6y-ZrtVVKyewxDf_CVE6BcWdgmRjGrGwe50_X5', [
            'content' => null,
            'embeds' => [
                [
                    'title' => $this->crud->getModel()->getTable() . " " . $action,
                    'description' => $message,
                    'color' => '7506394',
                ]
            ],
        ]);
    }

    /**
     * Add Dropdown Filter
     * @param array $statuses
     * @param string $column_name
     * @param string $label
     */
    function addDropdownFilter($statuses, $column_name, $label)
    {
        $this->crud->addFilter([
            Attributes::TYPE => FieldTypes::DROPDOWN,
            Attributes::NAME => $column_name,
            Attributes::LABEL => $label
        ], $statuses, function ($value) use ($column_name) {
            $this->crud->addClause('where', $column_name, $value);
        });
    }

    /**
     * Add Location Filter
     */
    function addLocationFilter()
    {
        $this->crud->addFilter([
            Attributes::TYPE => FieldTypes::DROPDOWN,
            Attributes::NAME => Attributes::LONGITUDE,
            Attributes::LABEL => "Location"
        ], [
            0 => "Without a Location",
            1 => "With a Location",
        ], function ($value) {
            if ($value == 1) {
                $this->crud->addClause('where', Attributes::LONGITUDE, "!=", null);
            } else {
                $this->crud->addClause('where', Attributes::LONGITUDE, null);
            }
        });
    }

    /**
     * Add Predefined Filter
     * @param string $column_name
     * @param string $label
     */
    function addBooleanFilter($column_name, $label)
    {
        $this->crud->addFilter([
            Attributes::TYPE => FieldTypes::DROPDOWN,
            Attributes::NAME => $column_name,
            Attributes::LABEL => $label
        ], $this->booleanOptions(), function ($value) use ($column_name) {
            $this->crud->addClause('where', $column_name, $value);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | COLUMNS
    |--------------------------------------------------------------------------
    */

    /**
     * Boolean Options
     * @return string[]
     */
    function booleanOptions()
    {
        return [
            false => "No",
            true => "Yes"
        ];
    }

    /**
     * Add Status Column
     * @param int $priority
     */
    function addStatusColumn($priority = 1)
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::STATUS_NAME,
            Attributes::LABEL => "Status",
            Attributes::PRIORITY => $priority
        ]);
    }

    /**
     * Add Column
     * @param $column_name
     * @param $label
     */
    function addColumn($column_name, $label)
    {
        $this->crud->addColumn([
            Attributes::NAME => $column_name,
            Attributes::LABEL => $label,
        ]);
    }

    /**
     * Add Types Column
     * @param int $priority
     */
    function addTypesColumn($priority = 1)
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::TYPE_NAME,
            Attributes::LABEL => "Page",
            Attributes::PRIORITY => $priority
        ]);
    }

    /**
     * Add Project Status Column
     * @param int $priority
     */
    function addProjectStatusColumn($priority = 1)
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::PROJECT_STATUS_NAME,
            Attributes::LABEL => "Project Status",
            Attributes::PRIORITY => $priority
        ]);
    }

    /**
     * Add Ads Status Column
     * @param int $priority
     */
    function addAdsStatusColumn($priority = 1)
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::AD_STATUS_NAME,
            Attributes::LABEL => "Status",
            Attributes::PRIORITY => $priority
        ]);
    }

    /**
     * Add Is Pre-defined Column
     * @param int $priority
     */
    function addIsPredefinedColumn($priority = 1)
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::PREDEFINED,
            Attributes::LABEL => "Pre-defined",
            Attributes::PRIORITY => $priority
        ]);
    }

    /**
     * Add Place Status Column
     * @param int $priority
     */
    function addPlaceStatusColumn($priority = 1)
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::PLACE_STATUS_NAME,
            Attributes::LABEL => "Place Status",
            Attributes::PRIORITY => $priority
        ]);
    }

    /**
     * Add Login Provider Name Column
     */
    function addLoginProviderNameColumn()
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::PROVIDER_NAME,
            Attributes::LABEL => "Provider Name",
        ]);
    }

    /**
     * Add Name Column
     * @param string|null $label
     * @param int $priority
     * @param string $column_name
     */
    function addNameColumn($label = null, $priority = 1, $column_name = Attributes::NAME)
    {
        if (is_null($label)) {
            $label = "Title";
        }
        $this->crud->addColumn([
            Attributes::NAME => $column_name,
            Attributes::LABEL => $label,
            Attributes::PRIORITY => $priority
        ]);
    }

    /**
     * @param $label
     * @param $name
     * @param $attribute
     * @param $model
     * @return void
     */
    function addRelationShipColumn($label = null, $name = null, $attribute = null, $model = null)
    {
        $this->crud->addColumn([
            Attributes::LABEL => $label, // Table column heading
            Attributes::TYPE => 'select_multiple',
            Attributes::NAME => $name, // the method that defines the relationship in your Model
            Attributes::ENTITY => $name, // the method that defines the relationship in your Model
            Attributes::ATTRIBUTES => $attribute, // foreign key attribute that is shown to user
            Attributes::MODEL => $model, // foreign key model
        ]);
    }

    function addSystemColumn($label = null, $name = null, $attribute = null, $model = null)
    {
        $this->crud->addColumn([
            Attributes::LABEL => "Systems", // Table column heading
            Attributes::TYPE => 'select_multiple',
            Attributes::NAME => 'systems', // the method that defines the relationship in your Model
            Attributes::ENTITY => 'systems', // the method that defines the relationship in your Model
            Attributes::ATTRIBUTES => Attributes::NAME, // foreign key attribute that is shown to user
            Attributes::MODEL => System::class, // foreign key model
        ]);
    }

    function addProjectColumn($label = null, $name = null, $attribute = null, $model = null)
    {
        $this->crud->addColumn([
            Attributes::NAME => 'projects', // name of relationship method in the model
            Attributes::TYPE => 'relationship',
            Attributes::LABEL => 'Project', // Table column heading
            'entity' => 'project_id', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => Project::class, // foreign key model
        ]);
    }

    /**
     * @param $label
     * @param $attribute_name
     * @param $search_logic
     * @param $search_column
     * @param $model
     * @return void
     */
    function addColumnWithSearchLogic($label = null, $attribute_name = null, $search_logic = null, $search_column = null, $model = null)
    {
        if (is_null($label)) {
            $label = "Name";
        }
        if (is_null($attribute_name)) {
            $attribute_name = Attributes::NAME;
        }
        if (!is_null($search_logic)) {
            $this->crud->addColumn([
                Attributes::LABEL => $label,
                Attributes::NAME => $attribute_name,
                Attributes::SEARCH_LOGIC => function ($query, $column, $searchTerm) use (&$search_logic, $search_column, $model) {
                    $entry = $model::query()->where($search_column, 'like', '%' . $searchTerm . '%')->pluck('id')->all();
                    $query->orWhereIn($search_logic, $entry);
                }
            ]);
        } else {
            $this->crud->addColumn([
                Attributes::LABEL => $label,
                Attributes::NAME => $attribute_name,
            ]);
        }

    }

    /**
     * @return void
     */
    function addRoleAndPermissionField()
    {
        $this->crud->addFilter(
            [
                'name' => 'role',
                'type' => 'dropdown',
                'label' => trans('backpack::permissionmanager.role'),
            ],
            config('permission.models.role')::all()->pluck('name', 'id')->toArray(),
            function ($value) { // if the filter is active
                $this->crud->addClause('whereHas', 'roles', function ($query) use ($value) {
                    $query->where('role_id', '=', $value);
                });
            }
        );

        // Extra Permission Filter
        $this->crud->addFilter(
            [
                'name' => 'permissions',
                'type' => 'select2',
                'label' => trans('backpack::permissionmanager.extra_permissions'),
            ],
            config('permission.models.permission')::all()->pluck('name', 'id')->toArray(),
            function ($value) { // if the filter is active
                $this->crud->addClause('whereHas', 'permissions', function ($query) use ($value) {
                    $query->where('permission_id', '=', $value);
                });
            }
        );
    }

    function addRolesColumn()
    {
        $this->crud->addColumn([
            'label' => trans('backpack::permissionmanager.roles'), // Table column heading
            'type' => 'select_multiple',
            'name' => 'roles', // the method that defines the relationship in your Model
            'entity' => 'roles', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => config('permission.models.role'), // foreign key model
        ]);
    }

    /**
     * Add Category Column
     * @param string|null $label
     * @param int $priority
     * @param string $column_name
     */
    function addCategoryColumn($label = "Category", $priority = 1, $column_name = Attributes::CATEGORY_NAME)
    {
        $this->crud->addColumn([
            Attributes::NAME => $column_name,
            Attributes::LABEL => $label,
            Attributes::PRIORITY => $priority
        ]);
    }

    /**
     * Add Is Featured Column
     * @param string|null $label
     * @param int $priority
     * @param string $column_name
     */
    function addIsFeaturedColumn($label = "Is Featured", $priority = 1, $column_name = Attributes::CATEGORY_NAME)
    {
        $this->crud->addColumn([
            Attributes::NAME => $column_name,
            Attributes::LABEL => $label,
            Attributes::PRIORITY => $priority
        ]);
    }

    /**
     * Add Class Name Column
     */
    function addClassNameColumn()
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::CLASS_NAME,
            Attributes::LABEL => "Class Name",
        ]);
    }

    /**
     * Add Class Name Column
     */
    function addClientNameColumn()
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::CLIENT_NAME,
            Attributes::LABEL => "Client Name",
        ]);
    }

    /**
     * Add Client Email Column
     */
    function addClientEmailColumn()
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::CLIENT_EMAIL,
            Attributes::LABEL => "Client Email",
        ]);
    }

    /**
     * Add Submitted At Column
     */
    function addSubmittedAtColumn()
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::SUBMITTED_AT,
            Attributes::LABEL => "Submitted At",
        ]);
    }

    /**
     * Add Icon Column
     */
    function addIconColumn()
    {
        CRUD::addColumn([
            Attributes::LABEL => "Icon",
            Attributes::NAME => Attributes::ICON,
            Attributes::TYPE => FieldTypes::ICONSET,
        ]);
    }

    /**
     * Add Length Days Column
     * @param int $priority
     */
    function addLengthDaysColumn($priority = 1)
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::LENGTH_DAYS,
            Attributes::LABEL => "Days",
            Attributes::PRIORITY => $priority
        ]);
    }

    /**
     * Add Email Column
     */
    function addEmailColumn($attribute = Attributes::EMAIL, $label = "Email")
    {
        $this->crud->addColumn([
            Attributes::NAME => $attribute,
            Attributes::LABEL => $label,
        ]);
    }

    /**
     * Add Place Name Column
     * @param int $priority
     */
    function addPlaceNameColumn($priority = 1)
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::PLACE_NAME,
            Attributes::LABEL => "Place Name",
            Attributes::PRIORITY => $priority
        ]);
    }

    /**
     * Add Event Status Column
     * @param int $priority
     */
    function addEventStatusColumn($priority = 1)
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::EVENT_STATUS_NAME,
            Attributes::LABEL => "Event Status",
            Attributes::PRIORITY => $priority
        ]);
    }

    /**
     * Add Contribute IS Free Status Column
     * @param int $priority
     */
    function addContributeIsFreeStatusColumn($priority = 1)
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::IS_FREE,
            Attributes::LABEL => "Is Free",
            Attributes::PRIORITY => $priority,
            Attributes::TYPE => FieldTypes::BOOLEAN
        ]);
    }

    /**
     * Add Place Type Name Column
     */
    function addTypeNameColumn()
    {
        CRUD::addColumn([
            Attributes::NAME => Attributes::TYPE_NAME,
        ]);
    }

    /**
     * Add Province Column
     */
    function addProvinceColumn()
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::PROVINCE_NAME,
            Attributes::LABEL => "Province",
        ]);
    }

    /**
     * Add Location Name Column
     * @param int $priority
     */
    function addLocationNameColumn($priority = 1)
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::LOCATION_NAME,
            Attributes::LABEL => "Location Name",
            Attributes::PRIORITY => $priority
        ]);
    }

    /**
     * Add Google Maps Field
     * @param null $tab_name
     */
    function addGoogleMapsField($tab_name = null)
    {
        $this->crud->addField([
            'name' => 'address-input', // do not change this
            'type' => 'google_maps', // do not change this
            'label' => "Google Maps",
            'attributes' => [
                'class' => 'form-control map-input', // do not change this, add more classes if needed
            ],
            Attributes::TAB => $tab_name,
        ]);
    }

    /**
     * Add Trip Name Column
     */
    function addTripNameColumn()
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::TRIP_NAME,
            Attributes::LABEL => "Trip Name",
        ]);
    }

    /**
     * Add Trip Name Column
     */
    function addDayColumn()
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::DAY,
            Attributes::LABEL => "Day",
        ]);
    }

    /**
     * Add Order Column
     */
    function addOrderColumn()
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::ORDER,
            Attributes::LABEL => "Order",
        ]);
    }

    /**
     * Add Item Name Column
     */
    function addItemNameColumn()
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::ITEM_NAME,
            Attributes::LABEL => "Related Item",
        ]);
    }

    /**
     * Add DateTimeStart Column
     */
    function addDateTimeStartColumn()
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::DATE_TIME_START,
            Attributes::LABEL => "Start Date",
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | FIELDS
    |--------------------------------------------------------------------------
    */

    /**
     * Add DateTimeEnd Column
     */
    function addDateTimeEndColumn()
    {
        $this->crud->addColumn([
            Attributes::NAME => Attributes::DATE_TIME_END,
            Attributes::LABEL => "End Date",
        ]);
    }

    /**
     * Add Email Verified At Field
     */
    function addEmailVerifiedAtField()
    {
        CRUD::addField([
            Attributes::NAME => Attributes::EMAIL_VERIFIED_AT,
            Attributes::TYPE => FieldTypes::TEXT,
            Attributes::LABEL => "Email Verified At",
        ]);
    }

    /**
     * Add Verification Code Field
     */
    function addVerificationCodeField()
    {
        CRUD::addField([
            Attributes::NAME => Attributes::VERIFICATION_CODE,
            Attributes::TYPE => FieldTypes::TEXT,
            Attributes::LABEL => "Verification Code",
        ]);
    }

    /**
     * Add Name Field
     * @param string|null $field_name
     * @param string|null $label
     * @param string|null $tab_name
     * @param string $dir
     * @param array $limit
     */
    function addNameField($field_name = null, $label = null, $tab_name = null, $dir = Attributes::LTR, $limit = [], $disabled = false)
    {
        if (is_null($field_name)) {
            $field_name = Attributes::NAME;
        }
        if (is_null($label)) {
            $label = "Title";
        }
        if (!is_array($limit)) {
            $limit = [
                Attributes::MAXLENGTH => $limit
            ];
        }
        CRUD::addField([
            Attributes::NAME => $field_name,
            Attributes::TYPE => FieldTypes::TEXT,
            Attributes::LABEL => ucwords($label),
            Attributes::ATTRIBUTES => array_merge([
                    Attributes::DIR => $dir,
                ], $limit) + $this->disabled($disabled),
            Attributes::TAB => $tab_name
        ]);
    }

    /**
     * Disabled
     * @param boolean $is_disabled
     * @return array
     */
    function disabled($is_disabled = false)
    {
        if ($is_disabled) {
            return [
                'readonly' => 'readonly',
                'disabled' => 'disabled',
            ];
        }
        return [];
    }

    /**
     * @param string $name
     * @param string $label
     */
    function addEmailField($name = Attributes::EMAIL, $label = 'Email')
    {
        CRUD::addField([
            Attributes::NAME => $name,
            Attributes::LABEL => $label,
            Attributes::TYPE => Attributes::EMAIL
        ]);
    }

    /**
     * Add Class Name Field
     */
    function addClassNameField()
    {
        CRUD::addField([
            Attributes::NAME => Attributes::CLASS_NAME,
            Attributes::TYPE => FieldTypes::HIDDEN,
            Attributes::LABEL => "Class Name",
        ]);
    }

    /**
     * Add Length Days Field
     * @param string|null $tab
     */
    function addLengthDaysField($tab = null)
    {
        CRUD::addField([
            Attributes::NAME => Attributes::LENGTH_DAYS,
            Attributes::TYPE => FieldTypes::NUMBER,
            Attributes::LABEL => "Number of Days",
            Attributes::ATTRIBUTES => [
                Attributes::MIN => 1
            ],
            Attributes::TAB => $tab,
        ]);
    }

    /**
     * Add Password Field
     */
    function addPasswordField($disabled = true)
    {
        CRUD::addField([
            Attributes::NAME => Attributes::PASSWORD,
            Attributes::TYPE => FieldTypes::TEXT,
            Attributes::LABEL => "Password",
            Attributes::ATTRIBUTES => $this->disabled($disabled),
        ]);
    }

    /**
     * Add Icon Field
     */
    function addIconField()
    {
        CRUD::addField([
            Attributes::LABEL => "Icon",
            Attributes::NAME => Attributes::ICON,
            Attributes::TYPE => FieldTypes::ICON_PICKER,
            Attributes::ICONSET => 'fontawesome' // options: fontawesome, glyphicon, ionicon, weathericon, mapicon, octicon, typicon, elusiveicon, materialdesign
        ]);
    }

    /**
     * Add Tag Category Field
     */
    function addTagCategoryField()
    {
        CRUD::addField([
            Attributes::LABEL => "Category",
            Attributes::NAME => Attributes::CATEGORY,
            Attributes::TYPE => FieldTypes::SELECT2_FROM_ARRAY,
            Attributes::OPTIONS => TagCategory::all(),
            Attributes::DEFAULT => TagCategory::ALL
        ]);
    }

    /**
     * Add User ID Field
     */
    function addUsersField($fake = false)
    {
        CRUD::addField([
            Attributes::LABEL => "User",
            Attributes::NAME => Attributes::USER_ID,
            Attributes::TYPE => FieldTypes::SELECT2_FROM_ARRAY,
            Attributes::OPTIONS => User::active()->get([Attributes::ID, Attributes::EMAIL, Attributes::USERNAME])->pluck(Attributes::EMAIL_OR_USERNAME_WITH_ID, Attributes::ID),
            Attributes::ALLOWS_NULL => true,
            Attributes::HINT => 'Optional (For Testing), only if you want to send the notification to a specific user',
            Attributes::FAKE => $fake
        ]);
    }

    /**
     * Add Ads Category Field
     */
    function addAdCategoryField($tab)
    {
        CRUD::addField([
            // 1-n relationship
            Attributes::LABEL => 'Category', // Table column heading
            Attributes::TYPE => FieldTypes::SELECT2,
            Attributes::NAME => Attributes::CATEGORY_ID, // the column that contains the ID of that connected entity;
            Attributes::ENTITY => Attributes::CATEGORY, // the method that defines the relationship in your Model
            Attributes::ATTRIBUTE => Attributes::TITLE, // foreign key attribute that is shown to user
            Attributes::MODEL => AdCategory::class, // foreign key model
            Attributes::DEFAULT => AdCategory::first(), // foreign key model
            Attributes::TAB => $tab, // foreign key model
        ]);
    }

    /**
     * Add Text Field
     * @param string $label
     * @param string $name
     * @param bool $disabled
     */
    function addTextField($label, $name, $disabled = false)
    {
        CRUD::addField([
            Attributes::LABEL => $label,
            Attributes::NAME => $name,
            Attributes::TYPE => FieldTypes::TEXT,
            Attributes::ATTRIBUTES => $this->disabled($disabled),
        ]);
    }

    /**
     * Add Login Provider ID Field
     */
    function addLoginProviderIDField()
    {
        CRUD::addField([
            Attributes::LABEL => "Login Provider ID",
            Attributes::NAME => Attributes::PROVIDER_ID,
            Attributes::TYPE => FieldTypes::TEXT,
            Attributes::ATTRIBUTES => $this->disabled(true),
        ]);
    }

    /**
     * Add Ticket Type Field
     * @param array|null $options
     * @param null $tab_name
     */
    function addTicketTypeField($options = null, $tab_name = null, $allow_null = true)
    {
        if (is_null($options)) {
            $options = TicketType::all();
        }
        CRUD::addField([
            Attributes::LABEL => "Ticket Type",
            Attributes::TYPE => FieldTypes::SELECT2_FROM_ARRAY,
            Attributes::NAME => Attributes::TICKET_TYPE,
            Attributes::DEFAULT => TicketType::FREE,
            Attributes::OPTIONS => $options,
            Attributes::ALLOWS_NULL => $allow_null,
            Attributes::TAB => $tab_name,
        ]);
    }

    /**
     * Add Place Type Field
     * @param bool $with_place_record
     * @param string|null $tab_name
     */
    function addPlaceTypeField($with_place_record = true, $tab_name = null)
    {
        /** @var Event $entry */
        $entry = $this->crud->getCurrentEntry();
        $selected = 2;
        if ($entry && !is_null($entry->place_id)) {
            $selected = 1;
        } else if ($entry && !is_null($entry->gmaps_link)) {
            $selected = 3;
        }

        // options
        $options = [];
        if ($with_place_record) {
            $options = [
                1 => "Place Record",
                2 => "Google Maps Record",
                3 => "Google Maps Link",
            ];
        } else {
            $options = [
                2 => "Google Maps Record",
                3 => "Google Maps Link",
            ];
        }

        // hide place name
        $hide_place_name = Attributes::PLACE_NAME;
        if ($with_place_record) {
            $hide_place_name = null;
        }

        CRUD::addField([
            Attributes::LABEL => "Place Type",
            Attributes::TYPE => FieldTypes::TOGGLE,
            Attributes::NAME => Attributes::PLACE_TYPE,
            Attributes::DEFAULT => $selected,
            Attributes::OPTIONS => $options,
            Attributes::HIDE_WHEN => [
                1 => [
                    Attributes::ADDRESS_INPUT,
                    Attributes::LONGITUDE,
                    Attributes::LATITUDE,
                    Attributes::GMAPS_LINK,
                    Attributes::PLACE_NAME,
                    Attributes::LOCATION_ID,
                ],
                2 => [
                    Attributes::PLACE_ID,
                    Attributes::GMAPS_LINK,
                    $hide_place_name
                ],
                3 => [
                    Attributes::ADDRESS_INPUT,
                    Attributes::PLACE_ID,
                    $hide_place_name
                ],
            ],
            Attributes::INLINE => false,
            Attributes::TAB => $tab_name,
        ]);
    }

    function addIsFreeRadioButton($status = null, $attribute_name = null, $tab_name = null, $label = null, $allow_null = false, $hint = null, $fake = false)
    {
        if (is_null($status)) {
            $status = ContributeStatus::all();
        }
        if (is_null($attribute_name)) {
            $attribute_name = Attributes::IS_FREE;
        }
        if (is_null($label)) {
            $label = Attributes::IS_FREE;
        }

        CRUD::addField([
            Attributes::LABEL => $label,
            Attributes::TYPE => FieldTypes::TOGGLE,
            Attributes::NAME => $attribute_name,
            Attributes::OPTIONS => $status,
            Attributes::TAB => $tab_name,
            Attributes::DEFAULT => 0,
            Attributes::HIDE_WHEN => [
                1 => [
                    Attributes::ITEM_PRICE,
                ],

            ],

            Attributes::INLINE => true,

        ]);
    }

    /**
     * Add Status Field
     * @param array|null $statuses
     * @param string|null $attribute_name
     * @param string|null $label
     * @param bool $allow_null
     * @param null $tab_name
     */
    function addStatusField($statuses = null, $attribute_name = null, $label = null, $tab_name = null, $allow_null = false, $hint = null, $fake = false)
    {
        if (is_null($statuses)) {
            $statuses = Status::all();
        }
        if (is_null($attribute_name)) {
            $attribute_name = Attributes::STATUS;
        }
        if (is_null($label)) {
            $label = ucfirst(Attributes::STATUS);
        }
        CRUD::addField([
            Attributes::LABEL => $label,
            Attributes::NAME => $attribute_name,
            Attributes::ALLOWS_NULL => $allow_null,
            Attributes::TYPE => FieldTypes::SELECT2_FROM_ARRAY,
            Attributes::OPTIONS => $statuses,
            Attributes::TAB => $tab_name,
            Attributes::FAKE => $fake,
            Attributes::HINT => $hint,
        ]);
    }

    /**
     * Add Is Featured Field
     * @param string $tab
     * @param bool $allow_null
     */
    function addIsFeaturedField($label, $tab = null, $allow_null = false)
    {
        CRUD::addField([
            Attributes::LABEL => $label,
            Attributes::NAME => Attributes::IS_FEATURED,
            Attributes::TYPE => FieldTypes::SELECT2_FROM_ARRAY,
            Attributes::OPTIONS => $this->booleanOptions(),
            Attributes::DEFAULT => false,
            Attributes::TAB => $tab,
            Attributes::ALLOWS_NULL => $allow_null,
        ]);
    }

    /**
     * Add Items Field
     * @param string $label
     * @param string|null $tab
     */
    function addItemField($label = "Item Name", $tab = null)
    {
        CRUD::addField([
            Attributes::NAME => Attributes::TYPE_ITEM_ID,
            Attributes::TYPE => FieldTypes::SELECT2,
            Attributes::LABEL => $label,
            Attributes::MODEL => Item::class,
            Attributes::ATTRIBUTE => Attributes::NAME,
            Attributes::TAB => $tab,
            Attributes::HINT => "Optional, only if you want the users to open an item when clicking on the notification"
        ]);
    }

    /**
     * Add Hidden Field
     * @param $key
     * @param $value
     * @return void
     */
    function addHiddenField($key)
    {
        $this->crud->addField([Attributes::TYPE => Attributes::HIDDEN, Attributes::NAME => $key]);
    }

    /**
     * Add All Day Field
     */
    function addAllDay()
    {
        CRUD::addField([
            Attributes::LABEL => "All Day",
            Attributes::NAME => Attributes::ALL_DAY,
            Attributes::HIDE_WHEN => [
                true => [
                    Attributes::TIME_START,
                    Attributes::TIME_END
                ]
            ],
            Attributes::TYPE => FieldTypes::TOGGLE,
            Attributes::OPTIONS => $this->booleanOptions(),
            Attributes::DEFAULT => false,
        ]);
    }

    /**
     * Add Media Field
     * @param string|null $label
     * @param string|null $tab_name
     */
    function addMediaField($label = null, $tab_name = null)
    {
        if (is_null($label)) {
            $label = "Media";
        }
        CRUD::addField([
            Attributes::TYPE => FieldTypes::CK_MEDIA,
            Attributes::NAME => Attributes::MEDIA,
            Attributes::LABEL => $label,
            Attributes::FAKE => true,
            Attributes::TAB => $tab_name,
        ]);
    }

    /**
     * Add Published At Field
     * @param string|null $tab_name
     */
    function addPublishedAtField($tab_name = null, $allow_null = false)
    {
        CRUD::addField([
            Attributes::NAME => Attributes::PUBLISHED_AT,
            Attributes::TYPE => FieldTypes::DATE_PICKER,
            Attributes::LABEL => "Published on",
            Attributes::DEFAULT => Carbon::today()->format(Values::CARBON_DATE_FORMAT_4),
            Attributes::DATE_PICKER_OPTIONS => [
                Attributes::TODAY_BTN => 'linked',
                Attributes::FORMAT => Values::CARBON_DATE_FORMAT_2,
                Attributes::LANGUAGE => 'en',
                Attributes::TODAY_HIGHLIGHT => true,
            ],
            Attributes::TAB => $tab_name,
            Attributes::ALLOWS_NULL => $allow_null
        ]);
    }

    /**
     * Add Date Field
     * @param string|null $tab_name
     */
    function addDateField($tab_name = null, $allow_null = false, $column = 'date', $label = 'date')
    {
        CRUD::addField([
            Attributes::NAME => $column,
            Attributes::TYPE => FieldTypes::DATE_PICKER,
            Attributes::LABEL => $label,
            Attributes::DEFAULT => Carbon::today()->format('Y-m-d'),
            Attributes::DATE_PICKER_OPTIONS => [
                Attributes::TODAY_BTN => 'linked',
                Attributes::FORMAT => Values::CARBON_FORMAT_2,
                Attributes::LANGUAGE => 'en',
                Attributes::TODAY_HIGHLIGHT => true,
            ],
            Attributes::TAB => $tab_name,
            Attributes::ALLOWS_NULL => $allow_null
        ]);
    }

    /**
     * Add Is Pre-defined Field
     * @param string|null $tab
     * @param string $type
     */
    function addIsPredefinedField($tab = null, $type = FieldTypes::CHECKBOX)
    {
        $this->crud->addField([
            Attributes::NAME => Attributes::IS_PREDEFINED,
            Attributes::LABEL => "Pre-defined?",
            Attributes::TYPE => $type,
            Attributes::VALUE => true,
            Attributes::TAB => $tab,
            Attributes::HINT => "<strong>Note:</strong> Pre-defined trips cannot be modified by mobile app users",
        ]);
    }

    /**
     * Add Longitude Field
     * @param bool $is_disabled
     * @param null $tab_name
     */
    function addLongitudeField($attribute_name, $label, $is_disabled = false, $tab_name = null, $default = null)
    {
        CRUD::addField([
            Attributes::NAME => $attribute_name,
            Attributes::TYPE => FieldTypes::NUMBER,
            Attributes::LABEL => $label,
            Attributes::DEFAULT => $default,
            Attributes::ATTRIBUTES => [
                    Attributes::REQUIRED => false,
                    Attributes::STEP => "any",
                ] + $this->disabled($is_disabled),
            Attributes::TAB => $tab_name,
        ]);
    }

    /**
     * Add Latitude Field
     * @param bool $is_disabled
     * @param null $tab_name
     */
    function addLatitudeField($is_disabled = false, $tab_name = null)
    {
        CRUD::addField([
            Attributes::NAME => Attributes::LATITUDE,
            Attributes::TYPE => FieldTypes::NUMBER,
            Attributes::LABEL => "Latitude",
            Attributes::ATTRIBUTES => [
                    Attributes::REQUIRED => false,
                    Attributes::STEP => "any",
                ] + $this->disabled($is_disabled),
            Attributes::TAB => $tab_name,
        ]);
    }

    /**
     * Add Description Field
     * @param string|null $name
     * @param string|null $label
     * @param string|null $tab_name
     * @param string $field_type
     * @param int $rows
     * @param integer|array $limit
     */
    function addDescriptionField($name = null, $label = null, $tab_name = null, $field_type = FieldTypes::TEXTAREA, $rows = 5, $limit = [], $hint = null)
    {
        if (is_null($name)) {
            $name = Attributes::DESCRIPTION;
        }
        if (is_null($label)) {
            $label = ucwords(Attributes::DESCRIPTION);
        }
        if (!is_array($limit)) {
            $limit = [
                Attributes::MAXLENGTH => $limit
            ];
        }
        CRUD::addField([
            Attributes::NAME => $name,
            Attributes::TYPE => $field_type,
            Attributes::LABEL => ucwords($label),
            Attributes::ATTRIBUTES => array_merge([
                Attributes::DIR => Attributes::RTL,
                Attributes::ROWS => $rows,
            ], $limit),
            Attributes::TAB => $tab_name,
            Attributes::HINT => $hint,
            'options' => [
                'autoParagraph' => false,
                Attributes::DIR => Attributes::RTL,
                "language" => 'ar',
//                'removePlugins' => 'embed,Embed',
                'extraPlugins' => 'iframe',
//                'removeButtons'        => 'Source,Save,Templates,NewPage,ExportPdf,Preview,Print,Cut,Undo,Find,Replace,SelectAll,Scayt,Form,Checkbox,Redo,PasteText,PasteFromWord,About,Maximize,ShowBlocks,BGColor,Styles,TextColor,Format,Font,FontSize,Image,CopyFormatting,NumberedList,Outdent,Blockquote,JustifyLeft,RemoveFormat,Indent,BulletedList,Underline,Strike,Subscript,Superscript,CreateDiv,JustifyCenter,Flash,Table,Anchor,Language,JustifyBlock,JustifyRight,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Italic,Bold',
            ]

        ]);
    }

    /**
     * @return void
     */
    public function addSystemsField()
    {
        $this->crud->addField([
            'type' => 'select2_multiple',
            'label' => 'Systems',
            'name' => 'systems', // the relationship name in your Model
            'entity' => 'systems', // the relationship name in your Model
            'attribute' => 'name', // attribute on Article that is shown to admin
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
        ]);
    }

    /**
     * Add Link Field
     * @param null $field_name
     * @param null $label
     * @param null $tab_name
     */
    function addLinkField($field_name = null, $label = null, $tab_name = null)
    {
        if (is_null($field_name)) {
            $field_name = Attributes::LINK;
        }

        if (is_null($label)) {
            $label = "Link";
        }

        CRUD::addField([
            Attributes::NAME => $field_name,
            Attributes::TYPE => FieldTypes::URL,
            Attributes::LABEL => $label,
            Attributes::REQUIRED => true,
            Attributes::TAB => $tab_name,
        ]);
    }

    /**
     * Add Place Field
     * @param string|null $tab_name
     * @param string $dir
     */
    function addPlaceField($tab_name = null, $dir = Attributes::LTR)
    {
        CRUD::addField([
            // 1-n relationship
            Attributes::LABEL => 'Place', // Table column heading
            Attributes::TYPE => FieldTypes::SELECT2,
            Attributes::NAME => Attributes::PLACE_ID, // the column that contains the ID of that connected entity;
            Attributes::ENTITY => Attributes::PLACE, // the method that defines the relationship in your Model
            Attributes::ATTRIBUTE => Attributes::NAME, // foreign key attribute that is shown to user
            Attributes::MODEL => Place::class, // foreign key model
            Attributes::TAB => $tab_name,
            Attributes::ATTRIBUTES => [
                Attributes::DIR => $dir,
            ],
        ]);
    }

    /**
     * Add Google Maps Link Field
     * @param string|null $tab_name
     */
    function addGoogleMapsLinkField($tab_name = null)
    {
        CRUD::addField([
            Attributes::LABEL => 'Google Maps Link',
            Attributes::TYPE => FieldTypes::TEXT,
            Attributes::NAME => Attributes::GMAPS_LINK,
            Attributes::TAB => $tab_name
        ]);
    }

    /**
     * Add Amenities Field
     * @param null $tab_name
     */
    function addAmenitiesField($tab_name = null)
    {
        CRUD::addField([
            Attributes::TYPE => FieldTypes::RELATIONSHIP,
            Attributes::LABEL => "Amenities",
            Attributes::NAME => Attributes::AMENITIES, // the method on your model that defines the relationship
            Attributes::AJAX => true,
            Attributes::INLINE_CREATE => [Attributes::ENTITY => Attributes::AMENITY], // specify the entity in singular
            Attributes::TAB => $tab_name,
        ]);
    }

    /**
     * Add Tags Field
     * @param string|null $tab_name
     */
    function addTagsField($tab_name = null)
    {
        CRUD::addField([
            Attributes::TYPE => FieldTypes::RELATIONSHIP,
            Attributes::NAME => Attributes::TAGS, // the method on your model that defines the relationship
            Attributes::AJAX => true,
            Attributes::INLINE_CREATE => [Attributes::ENTITY => Attributes::TAG], // specify the entity in singular
            Attributes::TAB => $tab_name,
            // that way the assumed URL will be "/admin/tag/inline/create"
        ]);
    }

    /**
     * Add Item Field
     * @param string|null $tab_name
     */
    function addItemsField($tab_name = null)
    {
        CRUD::addField([
            Attributes::TYPE => FieldTypes::REPEATABLE,
            Attributes::LABEL => "Items",
            Attributes::NAME => "items",
            Attributes::TAB => $tab_name,
            Attributes::FIELDS => [
                [
                    Attributes::NAME => Attributes::TYPE_ITEM_ID,
                    Attributes::TYPE => FieldTypes::SELECT2,
                    Attributes::LABEL => 'Name',
                    Attributes::MODEL => Item::class,
                    Attributes::ATTRIBUTE => Attributes::NAME,
                    Attributes::WRAPPER => [
                        Attributes::CLASS => 'form-group col-md-4'
                    ],
                ],
                [
                    Attributes::NAME => Attributes::DAY,
                    Attributes::TYPE => FieldTypes::NUMBER,
                    Attributes::LABEL => 'Day',
                    Attributes::ATTRIBUTES => [
                        Attributes::MIN => 1
                    ],
                    Attributes::WRAPPER => [
                        Attributes::CLASS => 'form-group col-md-4'
                    ],
                ],
                [
                    Attributes::NAME => Attributes::START_TIME,
                    Attributes::TYPE => FieldTypes::TIME,
                    Attributes::LABEL => 'Start Time',
                    Attributes::WRAPPER => [
                        Attributes::CLASS => 'form-group col-md-4'
                    ],
                ],
                [
                    Attributes::NAME => Attributes::END_TIME,
                    Attributes::TYPE => FieldTypes::TIME,
                    Attributes::ALLOWS_NULL => true,
                    Attributes::LABEL => 'End Time (Optional)',
                    Attributes::WRAPPER => [
                        Attributes::CLASS => 'form-group col-md-4'
                    ],
                ],
                [
                    Attributes::NAME => Attributes::DESCRIPTION,
                    Attributes::TYPE => FieldTypes::TEXTAREA,
                    Attributes::LABEL => 'Description',
                    Attributes::WRAPPER => [
                        Attributes::CLASS => 'form-group col-md-4'
                    ],
                ]
            ]
        ]);
    }

    /**
     * Add Types Field
     * @param null $model
     * @param null $tab_name
     */
    function addTypeField($model = null, $tab_name = null)
    {
        if ($model == TripItem::class) {
            CRUD::addField([    // Select2Multiple = n-n relationship (with pivot table)
                Attributes::NAME => Attributes::TYPE,
                Attributes::LABEL => "Type",
                Attributes::TYPE => FieldTypes::SELECT2_FROM_ARRAY,
                Attributes::OPTIONS => TripTypes::all(),
                Attributes::TAB => $tab_name,
            ]);
        } else {
            CRUD::addField([
                Attributes::LABEL => "Types",
                Attributes::TYPE => FieldTypes::RELATIONSHIP,
                Attributes::NAME => Attributes::TYPES, // the method on your model that defines the relationship
                Attributes::AJAX => true,
                Attributes::INLINE_CREATE => [Attributes::ENTITY => Attributes::TYPE], // specify the entity in singular
                Attributes::TAB => $tab_name,
                // that way the assumed URL will be "/admin/type/inline/create"
            ]);
        }
    }

    /**
     * Add Event Item Field
     */
    function addTripItemField()
    {
        CRUD::addField([
            Attributes::TYPE => FieldTypes::RELATIONSHIP,
            Attributes::NAME => Attributes::ITEMS, // the method on your model that defines the relationship
            Attributes::LABEL => "Trip Items",
            Attributes::AJAX => true,
            Attributes::INLINE_CREATE => [Attributes::ENTITY => 'trip-item'] // specify the entity in singular
            // that way the assumed URL will be "/admin/trip-item/inline/create"
        ]);
    }

    /**
     * Add Province Field
     */
    function addProvinceField()
    {
        CRUD::addField([
            // 1-n relationship
            Attributes::LABEL => 'Province', // Table column heading
            Attributes::TYPE => FieldTypes::SELECT2,
            Attributes::NAME => Attributes::PROVINCE_ID, // the column that contains the ID of that connected entity;
            Attributes::ENTITY => Attributes::PROVINCE, // the method that defines the relationship in your Model
            Attributes::ATTRIBUTE => Attributes::NAME, // foreign key attribute that is shown to user
            Attributes::MODEL => Province::class, // foreign key model
        ]);
    }

    /**
     * Add Interest Field
     */
    function addInterestField($tab_name = null)
    {
        CRUD::addField([
            // 1-n relationship
            Attributes::LABEL => 'Interest', // Table column heading
            Attributes::TYPE => FieldTypes::SELECT2,
            Attributes::NAME => Attributes::CATEGORY_ID, // the column that contains the ID of that connected entity;
            Attributes::ENTITY => Attributes::CATEGORY, // the method that defines the relationship in your Model
            Attributes::ATTRIBUTE => Attributes::NAME, // foreign key attribute that is shown to user
            Attributes::MODEL => Interest::class, // foreign key model
            Attributes::ALLOWS_NULL => false,
            Attributes::TAB => $tab_name
        ]);
    }

    /**
     * Add Activity Field
     */
    function addActivityField()
    {
        CRUD::addField([
            // 1-n relationship
            Attributes::LABEL => 'Activity', // Table column heading
            Attributes::TYPE => FieldTypes::SELECT2,
            Attributes::NAME => Attributes::ACTIVITY_ID, // the column that contains the ID of that connected entity;
            Attributes::ENTITY => Attributes::ACTIVITY, // the method that defines the relationship in your Model
            Attributes::ATTRIBUTE => Attributes::NAME, // foreign key attribute that is shown to user
            Attributes::MODEL => Activity::class, // foreign key model
            Attributes::ALLOWS_NULL => false
        ]);
    }

    /**
     * Add Vendor Field
     */
    function addVendorField()
    {
        CRUD::addField([
            // 1-n relationship
            Attributes::LABEL => 'Vendor', // Table column heading
            Attributes::TYPE => FieldTypes::SELECT2,
            Attributes::NAME => Attributes::VENDOR_ID, // the column that contains the ID of that connected entity;
            Attributes::ENTITY => Attributes::VENDOR, // the method that defines the relationship in your Model
            Attributes::ATTRIBUTE => Attributes::NAME, // foreign key attribute that is shown to user
            Attributes::MODEL => Vendor::class, // foreign key model
            Attributes::ALLOWS_NULL => false
        ]);
    }

    /**
     * Add Location Field
     * @param string|null $tab
     */
    function addLocationField($tab = null, $allow_null = true)
    {
        CRUD::addField([
            // 1-n relationship
            Attributes::LABEL => 'Location', // Table column heading
            Attributes::TYPE => FieldTypes::SELECT2,
            Attributes::NAME => Attributes::LOCATION_ID, // the column that contains the ID of that connected entity;
            Attributes::ENTITY => Attributes::LOCATION, // the method that defines the relationship in your Model
            Attributes::ATTRIBUTE => Attributes::NAME, // foreign key attribute that is shown to user
            Attributes::MODEL => Location::class, // foreign key model
            Attributes::REQUIRED => false,
            Attributes::ALLOWS_NULL => $allow_null,
            Attributes::TAB => $tab
        ]);
    }

    /**
     * Add Event Field
     */
    function addEventField()
    {
        CRUD::addField([  // Select2
            Attributes::LABEL => "Event",
            Attributes::TYPE => FieldTypes::SELECT2,
            Attributes::NAME => Attributes::EVENT_ID, // the db column for the foreign key

            // optional
            Attributes::ENTITY => Attributes::EVENT, // the method that defines the relationship in your Model
            Attributes::MODEL => Event::class, // foreign key model
            Attributes::ATTRIBUTE => Attributes::NAME, // foreign key attribute that is shown to user

            // also optional
            Attributes::OPTIONS => (function ($query) {
                return $query->orderBy('name', Attributes::ASC)->where(Attributes::STATUS, Status::PUBLISHED)->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);
    }

    /**
     * Add Event Date Field
     * @param string|null $tab_name
     * @param string|null $hint
     */
    function addEventDateField($tab_name = null, $hint = null)
    {
        CRUD::addField([
            Attributes::TYPE => FieldTypes::RELATIONSHIP,
            Attributes::LABEL => "Event Date",
            Attributes::NAME => Attributes::DATES, // the method on your model that defines the relationship
            Attributes::AJAX => true,
            Attributes::INLINE_CREATE => [
                Attributes::ENTITY => 'datetime', // specify the entity in singular
                Attributes::MODAL_CLASS => 'modal-dialog modal-lg', // use modal-sm, modal-lg to change width
            ],
            Attributes::TAB => $tab_name,
            Attributes::HINT => $hint,
        ]);
    }

    /**
     * Add Working Hours Field
     * @param string $label
     * @param string|null $tab
     * @param string|null $hint
     */
    function addWorkingHours($label = "Working Hours", $tab = null, $hint = null)
    {
        CRUD::addField([
            Attributes::TYPE => FieldTypes::RELATIONSHIP,
            Attributes::LABEL => $label,
            Attributes::NAME => Attributes::TIMING, // the method on your model that defines the relationship
            Attributes::AJAX => true,
            Attributes::INLINE_CREATE => [
                Attributes::ENTITY => 'working-hour', // specify the entity in singular
                Attributes::MODAL_CLASS => 'modal-dialog modal-lg', // use modal-sm, modal-lg to change width
            ],
            Attributes::TAB => $tab,
            Attributes::HINT => $hint
        ]);
    }

    /**
     * Add Event Start DateTime Field
     * @param string $label
     * @param $column_name
     * @param string|null $default
     * @param string|null $format
     */
    function addDateTimeField($label, $column_name, $default = null, $format = null)
    {
        if (is_null($format)) {
            $format = Values::CARBON_DATE_FORMAT_3;
        }

        CRUD::addField([
            Attributes::NAME => $column_name,
            Attributes::TYPE => FieldTypes::DATETIME_PICKER,
            Attributes::LABEL => $label,
            Attributes::DEFAULT => $default,
            Attributes::DATETIME_PICKER_OPTIONS => [
                Attributes::FORMAT => $format,
                Attributes::LANGUAGE => 'en'
            ],
        ]);
    }

    /**
     * Add Time Field
     * @param string|null $label
     * @param string|null $field_name
     */
    function addTimeField($label = null, $field_name = null)
    {
        if (is_null($label)) {
            $label = "Time";
        }

        if (is_null($field_name)) {
            $field_name = Attributes::TIME;
        }

        CRUD::addField([
            Attributes::NAME => $field_name,
            Attributes::TYPE => FieldTypes::TIME,
            Attributes::LABEL => $label,
        ]);

    }

    /**
     * Add Days Field
     */
    function addDaysField()
    {
        CRUD::addField([
            Attributes::NAME => Attributes::DAY,
            Attributes::TYPE => FieldTypes::SELECT2_FROM_ARRAY,
            Attributes::LABEL => "Day(s)",
            Attributes::OPTIONS => Carbon::getDays(),
            Attributes::ALLOWS_MULTIPLE => true,
            Attributes::ALLOWS_NULL => false,
            Attributes::STORE_AS_JSON => true,
        ]);
    }

    /**
     * Add Start Date Field
     * @param string|null $label
     * @param string|null $format
     * @param string|null $tab
     */
    function addStartDateField($label = null, $format = null, $tab = null)
    {
        if (is_null($label)) {
            $label = "Start Date (dd-mm-yyyy)";
        }
        if (is_null($format)) {
            $format = Values::CARBON_DATE_FORMAT_2;
        }
        CRUD::addField([   // date_picker
            Attributes::NAME => Attributes::START_DATE,
            Attributes::TYPE => FieldTypes::DATE_PICKER,
            Attributes::LABEL => $label,
            Attributes::TAB => $tab,
            Attributes::DATE_PICKER_OPTIONS => [
                Attributes::TODAY_BTN => 'linked',
                Attributes::FORMAT => $format,
                Attributes::LANGUAGE => 'en'
            ],
        ]);
    }

    /**
     * Add End Date Field
     * @param string|null $label
     * @param string|null $format
     * @param string|null $tab
     * @param string $type
     */
    function addEndDateField($label = null, $format = null, $tab = null, $type = FieldTypes::DATE_PICKER)
    {
        if (is_null($label)) {
            $label = "End Date (dd-mm-yyyy)";
        }
        if (is_null($format)) {
            $format = Values::CARBON_DATE_FORMAT_2;
        }
        CRUD::addField([   // date_picker
            Attributes::NAME => Attributes::END_DATE,
            Attributes::TYPE => $type,
            Attributes::LABEL => $label,
            Attributes::TAB => $tab,
            Attributes::VALUE => null,
            Attributes::DATE_PICKER_OPTIONS => [
                Attributes::TODAY_BTN => 'linked',
                Attributes::FORMAT => $format,
                Attributes::LANGUAGE => 'en'
            ],
        ]);
    }

    /**
     * Add Date Range Field
     * @param string|null $label
     * @param string|null $format
     * @param string|null $tab
     */
    function addDateRangeField($label = null, $format = null, $tab = null)
    {
        if (is_null($label)) {
            $label = "Event Date (From - To)";
        }
        if (is_null($format)) {
            $format = "DD-MM-y";
        }
        CRUD::addField([   // date_picker
            Attributes::NAME => [Attributes::START_DATE, Attributes::END_DATE],
            Attributes::LABEL => $label,
            Attributes::TYPE => FieldTypes::DATE_RANGE,
            Attributes::TAB => $tab,
            Attributes::DATE_RANGE_OPTIONS => [
                Attributes::TIMEPICKER => false,
                Attributes::LOCALE => [
                    Attributes::FORMAT => $format,
                    Attributes::LANGUAGE => 'en'
                ]
            ]
        ]);
    }

    /**
     * Add User Field
     */
    function addUserField($fake = false)
    {
        CRUD::addField([
            Attributes::LABEL => "User Email",
            Attributes::TYPE => FieldTypes::SELECT2,
            Attributes::NAME => Attributes::USER_ID, // the db column for the foreign key
            Attributes::ENTITY => Attributes::USER, // the method that defines the relationship in your Model
            Attributes::MODEL => User::class, // foreign key model
            Attributes::ATTRIBUTE => Attributes::EMAIL, // foreign key attribute that is shown to user
            Attributes::FAKE => $fake,
        ]);
    }

    /**
     * Add Featured Image Field
     * @param null $field_name
     * @param null $label
     * @param bool $remove_hint
     * @param null $hint_message
     * @param null $tab_name
     */
    function addFeaturedImageField($field_name = null, $label = null, $remove_hint = false, $hint_message = null, $tab_name = null)
    {
        if (is_null($field_name)) {
            $field_name = Attributes::FEATURED_IMAGE;
        }

        if (is_null($hint_message)) {
            $hint_message = "<strong>Note: </strong>Maximum image size is <strong>7MB.</strong>";
        }
        CRUD::addField([
            Attributes::LABEL => is_null($label) ? "Featured Image" : ucwords($label),
            Attributes::NAME => $field_name,
            Attributes::TYPE => Attributes::IMAGE,
            Attributes::HINT => !$remove_hint ? $hint_message : "",
            Attributes::CROP => false, // set to true to allow cropping, false to disable
            Attributes::ASPECT_RATIO => 1, // Commit or set to 0 to allow any aspect ratio
            Attributes::TAB => $tab_name,
        ]);
    }


    /**
     * Add Day Field
     */
    function addDayField()
    {
        CRUD::addField([
            Attributes::LABEL => "Day Number",
            Attributes::NAME => Attributes::DAY,
            Attributes::TYPE => FieldTypes::NUMBER,
            Attributes::HINT => "In which day of the trip this will be listed? (e.g. 1 -for the first day of the trip-)"
        ]);
    }


    /**
     * Add Ad Month Feild
     */
    function addAdMonthField($column = null, $title = '', $tab = null)
    {
        if (is_null($column)) {
            $column = 'Month';
        }
        CRUD::addField([
            Attributes::LABEL => $title,
            Attributes::NAME => $column,
            Attributes::TYPE => FieldTypes::NUMBER,
            Attributes::TAB => $tab,
        ]);

    }

    /**
     * Add Number Feild
     */
    function addNumberField($column = null, $title = '', $tab = null)
    {
        if (is_null($column)) {
            $column = 'Number';
        }
        CRUD::addField([
            Attributes::LABEL => $title,
            Attributes::NAME => $column,
            Attributes::TYPE => FieldTypes::NUMBER,
            Attributes::TAB => $tab,
        ]);

    }

    /**
     * Add Repeatable Prices Field
     */
    function addRepeatableAddonsField($tab)
    {

        CRUD::addField([
            Attributes::LABEL => 'Addons',
            Attributes::NAME => Attributes::ADDONS,
            'type' => 'repeatable',
            'fields' => [
                [
                    'name' => 'name',
                    'type' => 'text',
                    'label' => 'Name',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                ],
                [
                    'name' => 'price',
                    'type' => 'number',
                    'label' => 'Price',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                ],
            ],

            // optional
            'new_item_label' => 'Add Addon', // customize the text of the button
            'init_rows' => 0, // number of empty rows to be initialized, by default 1
            'min_rows' => 0, // minimum rows allowed, when reached the "delete" buttons will be hidden
            'max_rows' => 15, // maximum rows allowed, when reached the "new item" button will be hidden
            Attributes::TAB => $tab,

        ]);

    }

    /**
     * Add Repeatable Prices Field
     */
    function addRepeatablePricesField($tab)
    {

        CRUD::addField([
            Attributes::LABEL => 'Prices',
            Attributes::NAME => Attributes::PRICES,
            'type' => 'repeatable',
            'fields' => [
                [
                    'name' => 'count',
                    'type' => 'number',
                    'label' => 'Count',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name' => 'price',
                    'type' => 'number',
                    'label' => 'Price',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
            ],

            // optional
            'new_item_label' => 'Add Price', // customize the text of the button
            'init_rows' => 0, // number of empty rows to be initialized, by default 1
            'min_rows' => 1, // minimum rows allowed, when reached the "delete" buttons will be hidden
            'max_rows' => 15, // maximum rows allowed, when reached the "new item" button will be hidden
            Attributes::TAB => $tab,

        ]);

    }

    /**
     * Add Order Field
     */
    function addOrderField($hint = null, $is_disabled = false)
    {
        CRUD::addField([
            Attributes::LABEL => "Order",
            Attributes::NAME => Attributes::ORDER,
            Attributes::TYPE => FieldTypes::NUMBER,
            Attributes::HINT => $hint,
            Attributes::ATTRIBUTES => $this->disabled($is_disabled),
        ]);
    }

    /**
     * Add Item ID Field
     */
    function addItemIDField()
    {
        CRUD::addField([
            Attributes::LABEL => "Item ID",
            Attributes::NAME => Attributes::ITEM_ID,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------
    */


    /*
     * Save Featured Image
     */
    function saveFeaturedImage($media_ids = null)
    {
        $media_id = null;
        if (is_array($media_ids)) {
            $media_id = $media_ids[0];
        }

        /** @var Trip $trip */
        $trip = $this->crud->getCurrentEntry();

        if (!is_null($trip) && !is_null($media_id)) {
            $media = Media::find($media_id);
            if (!is_null($media)) {
                $trip->featured_image = Helpers::getPathFromCDN($media->url);
                $trip->featured_image_id = $media->id;
                $trip->save();
            }
        } else {
            $trip->featured_image = null;
            $trip->featured_image_id = null;
            $trip->save();
        }
    }

    function addUserTypeField()
    {
        CRUD::addField([
            Attributes::LABEL => "User Type",
            Attributes::NAME => Attributes::USER_TYPE,
            Attributes::TYPE => FieldTypes::SELECT2_FROM_ARRAY,
            Attributes::OPTIONS => UserType::all(),
            Attributes::DEFAULT => UserType::EMPLOYEE,
        ]);
    }

    /**
     * File Upload
     * @param Request $request
     * @return array|RedirectResponse|Response
     */
    public function fileUpload(Request $request)
    {
        $back_url = request()->headers->get(Attributes::REFERER) ?? null;
        $item_id = intval($request->item_id);
        $item_primary_column = Helpers::getModelPrimaryColumn($request->item_type);
        $item_type_relationship = Helpers::getModelRelationship($request->item_type);
        if (!$item_id) {
            return back()->withInput();
        }
        if ($request->hasFile(Attributes::MEDIA)) {
            $files = $request->allFiles()[Attributes::MEDIA];
            foreach ($files as $file) {
                $media = Helpers::uploadFile(null, $file, null, "uploads/media/images", false, true);
                if (!is_null($media) && !is_null($item_primary_column) && !is_null($item_type_relationship)) {
                    $item_type_relationship::createOrUpdate([
                        Attributes::MEDIA_ID => $media->id,
                        $item_primary_column => $item_id
                    ]);
                } else if (!is_null($media) && !is_null($item_primary_column) && $item_primary_column == Attributes::TRIP_ID) {
                    /** @var Trip $trip */
                    $trip = Trip::find($item_id);
                    if (!is_null($trip)) {
                        $trip->featured_image = Helpers::getPathFromCDN($media->url);
                        $trip->featured_image_id = $media->id;
                        $trip->save();
                    }
                }
            }
        }
        Alert::success('Media saved for this entry.')->flash();
        return !is_null($back_url) ? Redirect::to($back_url . "#media") : back();
    }

    /**
     * Media
     * @param array $media_ids
     */
    function media($media_ids = [])
    {
        $item_id = $this->crud->getCurrentEntryId();
        $media_ids = collect($media_ids);


        // type
        $type = basename($this->crud->getRoute());
//        dd($type);
        $model = Helpers::getModel($type);

        $item_primary_column = Helpers::getModelPrimaryColumn($type);
        $relationship_model = Helpers::getModelRelationship($type);

        if (is_null($item_id)) {
            return;
        }

        if (is_null($media_ids) || $media_ids->isEmpty()) {
            $media_ids = $this->crud->getRequest()->get(Attributes::MEDIA_IDS);
        }

        if (is_null($media_ids) || $media_ids->isEmpty()) {
            $relationship_model::where($item_primary_column, $item_id)->delete();
            return;

        }
//        dd('Before Featured Image');

        // featured image
        $featured_media_id = intval($media_ids->pull(0));
        $item = $model::find($item_id);

        if (!is_null($item)) {

            $relationship_model::createOrUpdate([
                $item_primary_column => $item_id,
                Attributes::MEDIA_ID => intval($featured_media_id),
                Attributes::ORDER => 1
            ]);

            $media = Media::find($featured_media_id);
            if (!is_null($media)) {
                $item->featured_image = $media->path;
            }
            $item->featured_image_id = $featured_media_id;
            $item->save();
        }


        // other media items
        $count = 2;
        if (!$media_ids->isEmpty()) {
            foreach ($media_ids as $media_id) {
                $relationship_model::createOrUpdate([
                    $item_primary_column => $item_id,
                    Attributes::MEDIA_ID => $media_id,
                    Attributes::ORDER => $count
                ]);
                $count++;
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Fetch
    |--------------------------------------------------------------------------
    */

    /**
     * Fetch Event
     */
    protected function fetchEvent()
    {
        return $this->fetch(Event::class);
    }

    /**
     * Fetch Event
     */
    protected function fetchEvents()
    {
        return $this->fetch(Event::class);
    }

    /**
     * Fetch Tag
     */
    protected function fetchTag()
    {
        return $this->fetch(Tag::class);
    }

    /**
     * Fetch Tags
     */
    protected function fetchTags()
    {
        return $this->fetch(Tag::class);
    }

    /**
     * Fetch Amenity
     */
    protected function fetchAmenity()
    {
        return $this->fetch(Amenity::class);
    }

    /**
     * Fetch Amenities
     */
    protected function fetchAmenities()
    {
        return $this->fetch(Amenity::class);
    }

    /**
     * Fetch Place
     */
    protected function fetchPlace()
    {
        return $this->fetch(Place::class);
    }

    /**
     * Fetch Place
     */
    protected function fetchPlaces()
    {
        return $this->fetch(Place::class);
    }

    /**
     * Fetch Project
     */
    protected function fetchProject()
    {
        return $this->fetch(Project::class);
    }

    /**
     * Fetch Project
     */
    protected function fetchProjects()
    {
        return $this->fetch(Project::class);
    }

    /**
     * Fetch Location
     */
    protected function fetchLocation()
    {
        return $this->fetch(Location::class);
    }

    /**
     * Fetch TripItem
     */
    protected function fetchTripItem()
    {
        return $this->fetch(TripItem::class);
    }

    /**
     * Fetch TripItemTag
     */
    protected function fetchTripItemTag()
    {
        return $this->fetch(TripItemTag::class);
    }

    /**
     * Fetch TripItemTag
     */
    protected function fetchType()
    {
        return $this->fetch(Type::class);
    }

    /**
     * Fetch TripItemTag
     */
    protected function fetchTypes()
    {
        return $this->fetch(Type::class);
    }

    /**
     * Fetch DateTime
     */
    protected function fetchDate()
    {
        return $this->fetch(Datetime::class);
    }

    /**
     * Fetch DateTime
     */
    protected function fetchDates()
    {
        return $this->fetch(Datetime::class);
    }

    /**
     * Fetch WorkingHour
     */
    protected function fetchTiming()
    {
        return $this->fetch(WorkingHour::class);
    }

    /**
     * Fetch WorkingHour
     */
    protected function fetchTimings()
    {
        return $this->fetch(WorkingHour::class);
    }
}
