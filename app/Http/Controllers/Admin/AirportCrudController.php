<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Attributes;
use App\Http\Requests\AirportRequest;
use App\Models\Airport;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AirportCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AirportCrudController extends CustomCrudController
{

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Airport::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/airport');
        CRUD::setEntityNameStrings('Airport', 'Airports');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        // Column: ID
        $this->addNameColumn('ID',null,Attributes::ID);

        // Column: Name
        $this->addNameColumn('Name',null,Attributes::NAME);

        // Column: Country
        $this->addNameColumn('Country',null,Attributes::COUNTRY_ID);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(AirportRequest::class);

        // Field: Name
        $this->addNameField(Attributes::NAME,'Name');

        // Field: Country
        CRUD::field(Attributes::COUNTRY);
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
