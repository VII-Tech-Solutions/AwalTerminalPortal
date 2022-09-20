<?php

namespace App\Filament\Resources\EliteServicesResource\Pages;

use App\Constants\Attributes;
use App\Filament\Resources\EliteServicesResource;
use App\Models\EliteServices;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditEliteServices extends EditRecord
{
    protected static string $resource = EliteServicesResource::class;

    protected function callBeforeAndAfterSyncHooks($name, $value, $callback): void
    {
        parent::callBeforeAndAfterSyncHooks($name, $value, $callback);
        $id = $this->data[Attributes::ID];
        if (Str::contains($name, [Attributes::SUBMISSION_STATUS_ID])) {
            $booker = collect($this->data[Attributes::BOOKER])->first();
            $email = $booker[Attributes::EMAIL];
            $name = $booker[Attributes::FIRST_NAME];
            $rejection_reason = $this->data[Attributes::REJECTION_REASON];
            EliteServices::changeStatus($id, $name, $email, $value, $rejection_reason);
        } elseif (Str::contains($name, [Attributes::PASSENGERS]) || Str::contains($name, [Attributes::SERVICE_ID])) {
            $passengers = collect($this->data[Attributes::PASSENGERS]);
            $service_id = collect($this->data[Attributes::SERVICE_ID])->first();
            $updated_values = EliteServices::changePriceAndPassengers($id, $passengers, $service_id);
            parent::callBeforeAndAfterSyncHooks('data' . Attributes::TOTAL, $updated_values[4], $callback);
            $this->form->model->number_of_infants = $updated_values[0];
            $this->form->model->number_of_children = $updated_values[1];
            $this->form->model->number_of_adults = $updated_values[2];
            $this->form->model->subtotal = $updated_values[3];
            $this->form->model->total = $updated_values[4];
            $this->form->model->vat_amount = $updated_values[5];
            $this->form->model->service_id = $updated_values[6];
            $this->fillForm();
        }
    }


    protected function getActions(): array
    {
        parent::getActions();
        return [

        ];
    }

}
