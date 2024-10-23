<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ManageOrganizationController;
use App\Http\Controllers\Admin\TrainingManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin', [Controller::class, 'index'])->name('admin.index');
Route::get('/admin/menu', [MenuController::class, 'index'])->name('admin.menus.index');
Route::get('/admin/menu/create', [MenuController::class, 'create'])->name('admin.menus.create');
Route::post('/admin/menu', [MenuController::class, 'store'])->name('admin.menus.store');
Route::get('/admin/menu/{id}/edit', [MenuController::class, 'edit'])->name('admin.menus.edit');
Route::put('/admin/menu/{id}', [MenuController::class, 'update'])->name('admin.menus.update');
Route::get('/admin/menu/{id}/delete', [MenuController::class, 'delete'])->name('admin.menus.delete');

Route::post('/admin/menus/{id}/toggle-status', [MenuController::class, 'toggleStatus'])->name('admin.menus.toggleStatus');


Route::prefix('admin')->group(function () {

    Route::get('sliders', [HomeController::class, 'slider_list'])->name('admin.slider_list');
    Route::get('sliders/create', [HomeController::class, 'slider_create'])->name('admin.slider_create');
    Route::post('sliders', [HomeController::class, 'slider_store'])->name('admin.slider_store');
    Route::get('sliders/{id}/edit', [HomeController::class, 'slider_edit'])->name('admin.slider_edit');
    Route::put('sliders/{id}', [HomeController::class, 'slider_update'])->name('admin.slider_update');
    Route::delete('sliders/{id}', [HomeController::class, 'slider_destroy'])->name('admin.slider_destroy');
    Route::post('sliders/{id}/toggle-status', [HomeController::class, 'slider_toggle_status'])->name('admin.slider_toggle_status');


    Route::get('/footer-images', [HomeController::class, 'footer_image_list'])->name('admin.footer_images.index');
    Route::get('/footer-images/create', [HomeController::class, 'footer_image_create'])->name('admin.footer_images.create');
    Route::post('/footer-images', [HomeController::class, 'footer_image_store'])->name('admin.footer_images.store');
    Route::get('/footer-images/{id}/edit', [HomeController::class, 'footer_image_edit'])->name('admin.footer_images.edit');
    Route::put('/footer-images/{id}', [HomeController::class, 'footer_image_update'])->name('admin.footer_images.update');
    Route::delete('/footer-images/{id}', [HomeController::class, 'footer_image_destroy'])->name('admin.footer_images.destroy');
    Route::put('footer-images/{id}/status', [HomeController::class, 'footer_images_status_update'])->name('admin.footer_images.status');

    Route::get('/quick-links', [HomeController::class, 'quick_link_list'])->name('admin.quick_links.index');
    Route::get('/quick-links/create', [HomeController::class, 'quick_link_create'])->name('admin.quick_links.create');
    Route::post('/quick-links/store', [HomeController::class, 'quick_link_store'])->name('admin.quick_links.store');
    Route::get('/quick-links/{id}/edit', [HomeController::class, 'quick_link_edit'])->name('admin.quick_links.edit');
    Route::put('/quick-links/{id}', [HomeController::class, 'quick_link_update'])->name('admin.quick_links.update');
    Route::delete('/quick-links/{id}', [HomeController::class, 'quick_link_destroy'])->name('admin.quick_links.destroy');
    Route::put('footer-images/{id}/status', [HomeController::class, 'quick_link_status_update'])->name('admin.quick_links.status');



    // faculty routes
    Route::get('/faculty', [ManageOrganizationController::class, 'facultyIndex'])->name('admin.faculty.index');
    Route::get('/faculty/create', [ManageOrganizationController::class, 'facultyCreate'])->name('admin.faculty.create');
    Route::post('/faculty', [ManageOrganizationController::class, 'facultyStore'])->name('admin.faculty.store');
    Route::get('/faculty/{id}/edit', [ManageOrganizationController::class, 'facultyEdit'])->name('admin.faculty.edit');
    Route::put('/faculty/{id}', [ManageOrganizationController::class, 'facultyUpdate'])->name('admin.faculty.update');
    Route::delete('/faculty/{id}', [ManageOrganizationController::class, 'facultyDestroy'])->name('admin.faculty.destroy');

    // Staff Routes
    Route::get('/staff', [ManageOrganizationController::class, 'staffIndex'])->name('admin.staff.index');
    Route::get('/staff/create', [ManageOrganizationController::class, 'staffCreate'])->name('admin.staff.create');
    Route::post('/staff', [ManageOrganizationController::class, 'staffStore'])->name('admin.staff.store');
    Route::get('/staff/{id}/edit', [ManageOrganizationController::class, 'staffEdit'])->name('admin.staff.edit');
    Route::put('/staff/{id}', [ManageOrganizationController::class, 'staffUpdate'])->name('admin.staff.update');
    Route::delete('/staff/{id}', [ManageOrganizationController::class, 'staffDestroy'])->name('admin.staff.destroy');



    Route::get('sections', [ManageOrganizationController::class, 'sectionIndex'])->name('sections.index');
    Route::get('sections/create', [ManageOrganizationController::class, 'sectionCreate'])->name('sections.create');
    Route::post('sections', [ManageOrganizationController::class, 'sectionStore'])->name('sections.store');
    Route::get('sections/{id}/edit', [ManageOrganizationController::class, 'sectionEdit'])->name('sections.edit');
    Route::put('sections/{id}', [ManageOrganizationController::class, 'sectionUpdate'])->name('sections.update');
    Route::delete('sections/{id}', [ManageOrganizationController::class, 'sectionDestroy'])->name('sections.destroy');


    Route::get('/section_category', [ManageOrganizationController::class, 'indexSectionCategory'])->name('admin.section_category.index');
    Route::get('/section_category/create', [ManageOrganizationController::class, 'createSectionCategory'])->name('admin.section_category.create');
    Route::post('/section_category/store', [ManageOrganizationController::class, 'storeSectionCategory'])->name('admin.section_category.store');
    Route::get('/section_category/{id}/edit', [ManageOrganizationController::class, 'editSectionCategory'])->name('admin.section_category.edit');
    Route::put('/section_category/{id}', [ManageOrganizationController::class, 'updateSectionCategory'])->name('admin.section_category.update');
    Route::delete('/section_category/{id}', [ManageOrganizationController::class, 'destroySectionCategory'])->name('admin.section_category.destroy');

    // Manage category route
    Route::get('category', [TrainingManagementController::class, 'categoryIndex'])->name('category.index');
    Route::get('category/create', [TrainingManagementController::class, 'categoryCreate'])->name('category.create');
    Route::post('category/store', [TrainingManagementController::class, 'categoryStore'])->name('category.store');
    Route::get('category/{id}/edit', [TrainingManagementController::class, 'categoryEdit'])->name('category.edit');
    Route::post('category/{id}/update', [TrainingManagementController::class, 'categoryUpdate'])->name('category.update');
    Route::post('category/{id}/delete', [TrainingManagementController::class, 'categoryDestroy'])->name('category.destroy');

    // Manage country route
    Route::get('country', [TrainingManagementController::class, 'countryIndex'])->name('country.index');
    Route::get('country/create', [TrainingManagementController::class, 'countryCreate'])->name('country.create');
    Route::post('country/store', [TrainingManagementController::class, 'countryStore'])->name('country.store');
    Route::get('country/{id}/edit', [TrainingManagementController::class, 'countryEdit'])->name('country.edit');
    Route::post('country/{id}/update', [TrainingManagementController::class, 'countryUpdate'])->name('country.update');
    Route::post('country/{id}/delete', [TrainingManagementController::class, 'countryDestroy'])->name('country.destroy');

    // Manage state route
    Route::get('state', [TrainingManagementController::class, 'stateIndex'])->name('state.index');
    Route::get('state/create', [TrainingManagementController::class, 'stateCreate'])->name('state.create');
    Route::post('state/store', [TrainingManagementController::class, 'stateStore'])->name('state.store');
    Route::get('state/{id}/edit', [TrainingManagementController::class, 'stateEdit'])->name('state.edit');
    Route::post('state/{id}/update', [TrainingManagementController::class, 'stateUpdate'])->name('state.update');
    Route::post('state/{id}/delete', [TrainingManagementController::class, 'stateDestroy'])->name('state.destroy');

    // Manage Districts route
    Route::get('district', [TrainingManagementController::class, 'districtIndex'])->name('district.index');
    Route::get('district/create', [TrainingManagementController::class, 'districtCreate'])->name('district.create');
    Route::post('district/store', [TrainingManagementController::class, 'districtStore'])->name('district.store');
    Route::get('district/{id}/edit', [TrainingManagementController::class, 'districtEdit'])->name('district.edit');
    Route::post('district/{id}/update', [TrainingManagementController::class, 'districtUpdate'])->name('district.update');
    Route::post('district/{id}/delete', [TrainingManagementController::class, 'districtDestroy'])->name('district.destroy');

    // Manage Exam route
    Route::get('exam', [TrainingManagementController::class, 'examIndex'])->name('exam.index');
    Route::get('exam/create', [TrainingManagementController::class, 'examCreate'])->name('exam.create');
    Route::post('exam/store', [TrainingManagementController::class, 'examStore'])->name('exam.store');
    Route::get('exam/{id}/edit', [TrainingManagementController::class, 'examEdit'])->name('exam.edit');
    Route::post('exam/{id}/update', [TrainingManagementController::class, 'examUpdate'])->name('exam.update');
    Route::post('exam/{id}/delete', [TrainingManagementController::class, 'examDestroy'])->name('exam.destroy');
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('news', NewsController::class);
    // Route::resource('faculty', FacultyMemberController::class);

});
