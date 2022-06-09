<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Attributes;
use App\Http\Requests\ContactUsRequest;
use App\Models\ContactUs;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ContactUsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ContactUsCrudController extends CustomCrudController
{

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(ContactUs::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/contact-us');
        CRUD::setEntityNameStrings('Contact Us', 'Contact Us');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        CRUD::setFromDb(); // fields

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
        CRUD::setValidation(ContactUsRequest::class);

        // Field: First Name
        $this->addNameField(Attributes::FIRST_NAME,'First Name');

        // Field: Last Name
        $this->addNameField(Attributes::LAST_NAME,'Last Name');

        // Field: Email
        $this->addEmailField();

        // Field: Message
        $this->addDescriptionField(Attributes::MESSAGE,'Message');

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
