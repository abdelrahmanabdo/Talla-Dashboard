<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BlogNeedReviewCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BlogNeedReviewCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Blog::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/blog/under-review');
        CRUD::setEntityNameStrings('blogs need review', 'blogs need review');
        CRUD::filters();
        CRUD::enableExportButtons();
        CRUD::enableResponsiveTable();
    }

    /**
     * 
     */
    protected function setupShowOperation() {
        CRUD::set('show.setFromDb', false);
        CRUD::addColumn([
          'label' => "User", 
          'name' => 'user_id',
          'entity' => 'user', 
          'attribute' => "name", 
          'model' => "App\Models\User",
        ]);
        CRUD::column('title');
        CRUD::column('body');
        CRUD::addColumn([
          'label' => 'Hashtags',
          'type' => 'json',
          'name' => 'hashtags'
        ]); 
        CRUD::addColumn([
          'label' => "Images", 
          'type' => "image",
          'name' => 'image.image',
          'entity' => 'images', 
        ]);
        CRUD::addButtonFromModelFunction('line', 'accept', 'acceptBlogButton', 'beginning');
        CRUD::addButtonFromModelFunction('line', 'reject', 'rejectBlogButton', 'end');
        CRUD::removeButton('update');
        CRUD::removeButton('delete');
    }
    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
          'label' => "User", 
          'type' => "select",
          'name' => 'user_id',
          'entity' => 'user', 
          'attribute' => "name", 
          'model' => "App\Models\User",
        ]);
        CRUD::column('title');
        CRUD::column('body');
        CRUD::addColumn([
          'label' => 'Hashtags',
          'type' => 'json',
          'name' => 'hashtags'
        ]); 
        CRUD::addColumn([
          'label' => "Images", 
          'type' => "relationship_count",
          'name' => 'images',
          'entity' => 'images', 
          'attribute' => "image", 
          'model' => "App\Models\BlogImage",
          'suffix' =>  ' image'
        ]);
        CRUD::column('created_at');
        CRUD::column('updated_at');

        CRUD::removeButton('update');
        CRUD::addClause('where', 'is_reviewed', 0);
        CRUD::orderBy('created_at', 'desc');
    }

    /**
     * Accept blog
     * @param {Int} $id blog id
     */
    public function accept_blog($id) {
      Blog::whereId($id)->update([
        'active' => 1,
        'is_reviewed' => 1
      ]);
      return redirect('/blog/under-review');
    }

    /**
     * Reject blog
     * 
     * @param {Int} $id blog id
     */
    public function reject_blog($id) {
      Blog::find($id)->update([
        'active' => 0,
        'is_reviewed' => 1
      ]);
      return redirect('/blog/under-review');
    }
}
