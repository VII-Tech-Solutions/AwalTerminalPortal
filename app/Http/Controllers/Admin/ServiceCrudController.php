<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Attributes;
use App\Constants\FieldTypes;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ServiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ServiceCrudController extends CustomCrudController
{
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Service::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/service');
        CRUD::setEntityNameStrings('service', 'services');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // columns
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ServiceRequest::class);
        $this->addNameField(Attributes::TITLE,'Title');
        $this->addDescriptionField(Attributes::DESCRIPTION,'Description',null,FieldTypes::CKEDITOR);
        $this->addNameField(Attributes::SERVICE_TYPE,'Service Type');
        $this->addNumberField(Attributes::PRICE,'Price');
        $this->addStatusField();
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
