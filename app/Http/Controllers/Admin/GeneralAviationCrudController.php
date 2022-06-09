<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Attributes;
use App\Http\Requests\GeneralAviationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Google\Service\Dfareporting\Flight;

/**
 * Class GeneralAviationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class GeneralAviationCrudController extends CustomCrudController
{

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\GeneralAviationServices::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/general-services');
        CRUD::setEntityNameStrings('general-services', 'general services');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->addNameColumn('ID',1,Attributes::ID);
        $this->addNameColumn('Submitted At', 1,Attributes::CREATED_AT );
        $this->addNameColumn('Aircraft type',1,Attributes::AIRCRAFT_TYPE);
        $this->addNameColumn('Registration number', 1,Attributes::REGISTRATION_NUMBER);
        $this->addNameColumn('Arrival date',1,Attributes::ARRIVAL_DATE);
        $this->addNameColumn('Lead passenger name',1,Attributes::LEAD_PASSENGER_NAME);
        $this->addNameColumn('Remarks',1,Attributes::REMARKS);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(GeneralAviationRequest::class);
        CRUD::field(Attributes::AIRCRAFT_TYPE);
        CRUD::field(Attributes::REGISTRATION_NUMBER);
        CRUD::field(Attributes::MTOW);
        CRUD::field(Attributes::LEAD_PASSENGER_NAME);
        CRUD::field(Attributes::LANDING_PURPOSE);
        CRUD::field(Attributes::LANDING_PURPOSE);
        CRUD::field(Attributes::ARRIVAL_CALL_SIGN);
        CRUD::field(Attributes::ARRIVING_FROM_AIRPORT);
        CRUD::field(Attributes::ESTIMATED_TIME_OF_ARRIVAL);
        CRUD::field(Attributes::ARRIVAL_DATE);
        CRUD::field(Attributes::ARRIVAL_FLIGHT_NATURE);
        CRUD::field(Attributes::ARRIVAL_PASSENGER_COUNT);
        CRUD::field(Attributes::DEPARTURE_CALL_SIGN);
        CRUD::field(Attributes::DEPARTURE_TO_AIRPORT);
        CRUD::field(Attributes::ESTIMATED_TIME_OF_DEPARTURE);
        CRUD::field(Attributes::DEPARTURE_DATE);
        CRUD::field(Attributes::DEPARTURE_FLIGHT_NATURE);
        CRUD::field(Attributes::DEPARTURE_PASSENGER_COUNT);
        CRUD::field(Attributes::OPERATOR_FULL_NAME);
        CRUD::field(Attributes::OPERATOR_COUNTRY);
        CRUD::field(Attributes::OPERATOR_TEL_NUMBER);
        CRUD::field(Attributes::OPERATOR_EMAIL);
        CRUD::field(Attributes::OPERATOR_ADDRESS);
        CRUD::field(Attributes::OPERATOR_BILLING_ADDRESS);
        CRUD::field(Attributes::IS_USING_AGENT);
        CRUD::field(Attributes::AGENT_FULLNAME);
        CRUD::field(Attributes::AGENT_COUNTRY);
        CRUD::field(Attributes::AGENT_PHONENUMBER, 'Agent phone number');
        CRUD::field(Attributes::AGENT_ADDRESS);
        CRUD::field(Attributes::AGENT_BILLING_ADDRESS);
        CRUD::field(Attributes::TRANSPORT_HOTEL_NAME);
        CRUD::field(Attributes::TRANSPORT_TIME);
        CRUD::field(Attributes::REMARKS);
        CRUD::field(Attributes::ATTACHMENTS);
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
