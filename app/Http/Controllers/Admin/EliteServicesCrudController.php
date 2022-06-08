<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Attributes;
use App\Constants\FieldTypes;
use App\Constants\FlightClasses;
use App\Constants\FlightType;
use App\Constants\PassengerTitles;
use App\Http\Requests\AirportRequest;
use App\Http\Requests\EliteServicesRequest;
use App\Models\EliteServices;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Google\Service\Dfareporting\Flight;

/**
 * Class EliteServicesCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
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
        CRUD::setModel(\App\Models\EliteServices::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/elite-services');
        CRUD::setEntityNameStrings('elite services', 'elite services');
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
//        CRUD::column('flight_types_name');
        $this->addNameColumn('Booking ID',1,Attributes::ID);
        $this->addNameColumn('Submission Date',1,Attributes::CREATED_AT);

        CRUD::column('time');
        CRUD::column('flight_number');
        CRUD::column('number_of_adults');
        CRUD::column('number_of_children');
        CRUD::column('number_of_infants');
//        Crud::column(Attributes::PASSENGER);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
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

        $this->addStatusField(FlightType::all(),Attributes::FLIGHT_TYPE,'Flight Type');
        CRUD::field(Attributes::DATE);
        CRUD::field(Attributes::TIME);
        $this->addNameField(Attributes::FLIGHT_NUMBER,'Flight Number');
        $this->addNumberField(Attributes::NUMBER_OF_ADULTS,'Number of adults');
        $this->addNumberField(Attributes::NUMBER_OF_CHILDREN,'Number of children');
        $this->addNumberField(Attributes::NUMBER_OF_INFANTS,'Number of infants');
        $this->addPassengerRepeatable();

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
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
