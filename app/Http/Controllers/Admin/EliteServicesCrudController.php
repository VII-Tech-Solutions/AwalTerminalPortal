<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Attributes;
use App\Constants\FlightType;
use App\Http\Requests\EliteServicesRequest;
use App\Models\EliteServices;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EliteServicesCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class EliteServicesCrudController extends CustomCrudController
{

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(EliteServices::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/elite-services');
        CRUD::setEntityNameStrings('Elite Service', 'Elite Services');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setValidation(EliteServicesRequest::class);

        // Column: Booking ID
        $this->addNameColumn('Booking ID',1,Attributes::ID);

        // Column: Submission Date
        $this->addNameColumn('Submission Date',1,Attributes::CREATED_AT);

        // Column: Time
        CRUD::column('time');

        // Column: Flight Number
        CRUD::column('flight_number');

        // Column: Number of Adults
        CRUD::column('number_of_adults');

        // Column: Number of Children
        CRUD::column('number_of_children');

        // Column: Number of Infants
        CRUD::column('number_of_infants');
        CRUD::column('number_of_adults');

    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(EliteServicesRequest::class);

        // Field: Status
        $this->addStatusField(FlightType::all(),Attributes::FLIGHT_TYPE,'Flight Type');

        // Field: Date
        CRUD::field(Attributes::DATE);

        // Field: Time
        CRUD::field(Attributes::TIME);

        // Field: Flight Number
        $this->addNameField(Attributes::FLIGHT_NUMBER,'Flight Number');

        // Field: Number of adults
        $this->addNumberField(Attributes::NUMBER_OF_ADULTS,'Number of adults');

        // Field: Number of children
        $this->addNumberField(Attributes::NUMBER_OF_CHILDREN,'Number of children');

        // Field: Number of infants
        $this->addNumberField(Attributes::NUMBER_OF_INFANTS,'Number of infants');

        // Field: Passengers
        $this->addPassengerRepeatable();
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
