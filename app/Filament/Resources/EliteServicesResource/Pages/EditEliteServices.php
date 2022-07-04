<?php

namespace App\Filament\Resources\EliteServicesResource\Pages;

use App\Constants\AdminUserType;
use App\Constants\Attributes;
use App\Filament\Resources\EliteServicesResource;
use App\Helpers;
use App\Models\EliteServices;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditEliteServices extends EditRecord
{
    protected static string $resource = EliteServicesResource::class;

    protected function callBeforeAndAfterSyncHooks($name, $value, $callback): void
    {
        parent::callBeforeAndAfterSyncHooks($name, $value, $callback);

        if (Str::contains($name, [Attributes::SUBMISSION_STATUS_ID])) {
            $id = $this->data[Attributes::ID];
            $booker = collect($this->data[Attributes::BOOKER])->first();
            $email = $booker[Attributes::EMAIL];
            $name = $booker[Attributes::FIRST_NAME];
            $rejection_reason = $this->data[Attributes::REJECTION_REASON];
            EliteServices::changeStatus($id, $name, $email, $value, $rejection_reason);
        }
    }


    protected function getActions(): array
    {
        parent::getActions();
        $user = auth()->user();
        return [
//            Action::make('Change Status')
//                ->action(function (array $data): void {
//                    $this->record->totalPrice()->associate($data[Attributes::TOTAL]);
//                    $this->record->save();
//                })
//                ->requiresConfirmation()
//                ->color('primary')
//                ->form([
//                    TextInput::make(Attributes::TOTAL)
//                        ->numeric()
//                        ->suffix('BHD')
//                        ->label(Helpers::readableText(Attributes::TOTAL))->disabled(!$user->canAccess(AdminUserType::SUPER_ADMIN)),
//
//                    Select::make(Attributes::OFFLINE_PAYMENT_METHOD)
//                        ->label('Offline Payment Method')
//                        ->options(['Cash' => 'Cash',
//                            'Card' => 'Card',
//                            'Cheque' => 'Cheque',
//                            'Bank transfer' => 'Bank transfer'])->visible(),
//                ]),
            Action::make('delete')
                ->action(fn() => $this->record->delete())
                ->requiresConfirmation()->color('danger'),

        ];
    }

}
