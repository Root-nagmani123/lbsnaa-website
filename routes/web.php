<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ManageOrganizationController;
use App\Http\Controllers\Admin\CourseController;


use App\Http\Controllers\Admin\ManageSouvenirController;
use App\Http\Controllers\Admin\UserManagementController;


use App\Http\Controllers\Admin\TrainingManagementController;
use App\Http\Controllers\Admin\SurveyController;
use App\Http\Controllers\Admin\SocialmediaController;
use App\Http\Controllers\Admin\ViewprofileController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\CoursesubCategoryController;

// Indrajeet
use App\Http\Controllers\Admin\OrganiserController;
use App\Http\Controllers\Admin\CoordinatorController;
use App\Http\Controllers\Admin\ManageVenueController;
use App\Http\Controllers\Admin\ManageFoundersController;
use App\Http\Controllers\Admin\ManageCadresController;

use App\Http\Controllers\Admin\ManageTenderController;
use App\Http\Controllers\Admin\ManageVacancyController;
use App\Http\Controllers\Admin\ManageEventsController;


use App\Http\Controllers\Admin\ManageMediaCenterController;
use App\Http\Controllers\Admin\ManageVideoController;
use App\Http\Controllers\Admin\ManageMediaCategoriesController;
use App\Http\Controllers\Admin\ManagePhotoGalleryController;
use App\Http\Controllers\Admin\ManageAuditController;

use App\Http\Controllers\Admin\Micro\MicroManageAuditController;


// Indrajeet

// For Micro Website


use App\Http\Controllers\Admin\Micro\TrainingProgramController;
use App\Http\Controllers\Admin\Micro\OrganizationSetupController;
use App\Http\Controllers\Admin\Micro\MicroManageVacancyController;
use App\Http\Controllers\Admin\Micro\MicroVideoGalleryController;

use App\Http\Controllers\Admin\Micro\MicroManageMediaCenterController;
use App\Http\Controllers\Admin\Micro\ManageResearchCentreController;
use App\Http\Controllers\Admin\Micro\ManageNewsController;
use App\Http\Controllers\Admin\Micro\MicroMenuController;
use App\Http\Controllers\Admin\Micro\ManageQuickLinksController;
use App\Http\Controllers\Admin\Micro\MicroManagePhotoGalleryController;

use App\Http\Controllers\Admin\Micro\MicroSliderController;


//front data
use App\Http\Controllers\User\HomeFrontController;

//Micro-Sites 
use App\Http\Controllers\User\HomeFrontmicroController;

use App\Http\Controllers\User\HomePagesMicroController;


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

Route::get('/', [HomeFrontController::class,'index'])->name('home');
Route::get('/news/{slug}', [HomeFrontController::class,'get_news'])->name('user.newsbyslug');
Route::get('/menu/{slug}', [HomeFrontController::class, 'get_navigation_pages'])->name('user.navigationpagesbyslug');
Route::get('/footer_menu/{slug}', [HomeFrontController::class, 'footer_menu'])->name('user.footer_menu');
Route::get('/updates/{slug}', [HomeFrontController::class, 'letest_updates'])->name('user.letest_updates');
Route::get('/news-listing', [HomeFrontController::class, 'news_listing'])->name('user.news_listing');
Route::get('/news-old-listing', [HomeFrontController::class, 'news_old_listing'])->name('user.news_old_listing');
Route::get('/tenders', [HomeFrontController::class, 'tenders'])->name('user.tenders');
Route::get('/tenders-archive', [HomeFrontController::class, 'tenders_archive'])->name('user.tenders_archive');
Route::get('/faculty', [HomeFrontController::class, 'faculty'])->name('user.faculty');
Route::get('/staff', [HomeFrontController::class, 'staff'])->name('user.staff');
Route::get('/vacancy', [HomeFrontController::class, 'vacancy'])->name('user.vacancy');
Route::get('/cms/training_cal', [HomeFrontController::class, 'training_cal'])->name('user.training_cal');
Route::get('/course_listing/{slug}', [HomeFrontController::class, 'get_course_list_pages'])->name('user.courseslug');
Route::get('/course_full_destails/{slug}', [HomeFrontController::class, 'get_course_details_pages'])->name('user.courseDetailslug');
Route::get('/rti', [HomeFrontController::class, 'rti_main_page'])->name('user.get_rti_page');
Route::get('/rti/{slug}', [HomeFrontController::class, 'get_rti_page_details'])->name('user.get_rti_page_details');

Route::get('/souvenir', [HomeFrontController::class, 'souvenir'])->name('user.souvenir');
Route::get('/feedback', [HomeFrontController::class, 'feedback'])->name('user.feedback');
Route::get('/mediagallery', [HomeFrontController::class, 'mediagallery'])->name('user.mediagallery');
Route::get('/photogallery', [HomeFrontController::class, 'photogallery'])->name('user.photogallery');
Route::get('/view_all_photogallery', [HomeFrontController::class, 'view_all_photogallery'])->name('user.view_all_photogallery');
Route::get('/organization', [HomeFrontController::class, 'organization'])->name('user.organization');
Route::POST('/feedback_store', [HomeFrontController::class, 'storeFeedback'])->name('feedback.store');


//micro 
// Route::get('/lbsnaa-sub', [HomeFrontmicroController::class,'index'])->name('user.micrositebyslug');
Route::get('/lbsnaa-sub/{slug}', [HomeFrontmicroController::class, 'index'])->name('user.micrositebyslug');

Route::get('/lbsnaa-sub/micromenu/{slug}', [HomeFrontmicroController::class, 'get_navigation_pages'])->name('user.navigationmenubyslug');
//micro 
// Route::get('/lbsnaa-sub', [HomeFrontmicroController::class,'index'])->name('user.micrositebyslug');
// Indrajeet Home page dynamic
Route::get('/lbsnaa-sub/media_gallery', [HomePagesMicroController::class,'media_gallery'])->name('user.media_gallery');
Route::get('/photo-galleries/filterGallery', [HomePagesMicroController::class, 'filterGallery'])->name('photoGalleries.filterGallery');
Route::get('/lbsnaa-sub/calendar', [HomePagesMicroController::class, 'calendar'])->name('calendar');
Route::get('/lbsnaa-sub/news', [HomePagesMicroController::class, 'news'])->name('news');
Route::get('/lbsnaa-sub/news/{id}', [HomePagesMicroController::class, 'newsdetails'])->name('news.details');
Route::get('/lbsnaa-sub/mediagallery', [HomePagesMicroController::class, 'mediagallery'])->name('mediagallery');
Route::get('/lbsnaa-sub/video-gallery', [HomePagesMicroController::class, 'videoGallery'])->name('videoGallery');




// 30/12/2024
// For micro 



// 30/12/2024









Route::middleware('auth')->group(function () {
    Route::get('/admin', [Controller::class, 'index'])->name('admin.index');


Route::get('/admin/feedback-list', [MenuController::class, 'feedback_list'])->name('admin.feedback_list');


Route::get('/admin/menu', [MenuController::class, 'index'])->name('admin.menus.index');
Route::get('/admin/menu/create', [MenuController::class, 'create'])->name('admin.menus.create');
Route::post('/admin/menu', [MenuController::class, 'store'])->name('admin.menus.store');
Route::get('/admin/menu/{id}/edit', [MenuController::class, 'edit'])->name('admin.menus.edit');
Route::put('/admin/menu/{id}', [MenuController::class, 'update'])->name('admin.menus.update');
Route::get('/admin/menu/{id}/delete', [MenuController::class, 'delete'])->name('admin.menus.delete');

Route::post('/admin/menus/{id}/toggle-status', [MenuController::class, 'toggleStatus'])->name('admin.menus.toggleStatus');


Route::prefix('admin')->group(function () {

    Route::get('module', [UserManagementController::class, 'index'])->name('UserManagement.module');
  Route::post('/module', [UserManagementController::class, 'store'])->name('module.store');
Route::post('/module/{id}', [UserManagementController::class, 'update'])->name('module.update');
Route::delete('/module/{id}', [UserManagementController::class, 'destroy'])->name('module.destroy');


Route::get('/users', [UserManagementController::class, 'users_index'])->name('users.index'); // List users
Route::get('/users/add', [UserManagementController::class, 'users_create'])->name('users.create'); // Show add form
Route::post('/users/store', [UserManagementController::class, 'users_store'])->name('users.store'); // Add user
Route::get('/users/edit/{id}', [UserManagementController::class, 'users_edit'])->name('users.edit'); // Show edit form
Route::post('/users/update/{id}', [UserManagementController::class, 'users_update'])->name('users.update'); // Update user
Route::post('/users/delete/{id}', [UserManagementController::class, 'users_destroy'])->name('users.delete'); // Delete user
Route::post('/users/updateStatus/{id}', [UserManagementController::class, 'updateStatus'])->name('users.updateStatus');


Route::get('/users/permissions/{id}', [UserManagementController::class, 'permissions'])->name('users.permissions');
Route::post('/users/permissions/update', [UserManagementController::class, 'updatePermissions'])->name('users.permissions.update');




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

    Route::get('/section-category/{id}', [ManageOrganizationController::class, 'indexSectionCategory'])->name('admin.section-category.index');

    Route::get('/section_category/create', [ManageOrganizationController::class, 'createSectionCategory'])->name('admin.section_category.create');
    Route::post('/section_category/store', [ManageOrganizationController::class, 'storeSectionCategory'])->name('admin.section_category.store');
    Route::get('/section_category/{id}/edit', [ManageOrganizationController::class, 'editSectionCategory'])->name('admin.section_category.edit');
    Route::put('/section_category/{id}', [ManageOrganizationController::class, 'updateSectionCategory'])->name('admin.section_category.update');
    Route::delete('/section_category/{id}', [ManageOrganizationController::class, 'destroySectionCategory'])->name('admin.section_category.destroy');


    // Route::get('/admin/section_category/{catid}', [ManageOrganizationController::class, 'index'])->name('admin.section_category');

    Route::get('/admin/section_category', [ManageOrganizationController::class, 'indexSectionCategory'])->name('admin.section_category');



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
    

    // Manage Exam route
    Route::get('survey', [SurveyController::class, 'surveyIndex'])->name('survey.index');
    Route::get('survey/create', [SurveyController::class, 'surveyCreate'])->name('survey.create');
    Route::post('survey/store', [SurveyController::class, 'surveyStore'])->name('survey.store');
    Route::get('survey/{id}/edit', [SurveyController::class, 'surveyEdit'])->name('survey.edit');
    Route::post('survey/{id}/update', [SurveyController::class, 'surveyUpdate'])->name('survey.update');
    Route::post('survey/{id}/delete', [SurveyController::class, 'surveyDestroy'])->name('survey.destroy');

    // Manage Social media route
    Route::get('socialmedia', [SocialmediaController::class, 'SocialmediaIndex'])->name('socialmedia.index');
    Route::post('socialmedia/store', [SocialmediaController::class, 'SocialmediaStore'])->name('socialmedia.store');

    Route::get('souvenir', [ManageSouvenirController::class, 'index'])->name('souvenir.index'); // List all categories
    Route::get('souvenir/create', [ManageSouvenirController::class, 'create'])->name('souvenir.create'); // Show create form
    Route::post('souvenir', [ManageSouvenirController::class, 'store'])->name('souvenir.store'); // Store new category
    Route::get('souvenir/{id}/edit', [ManageSouvenirController::class, 'edit'])->name('souvenir.edit'); // Show edit form
    Route::put('souvenir/{id}', [ManageSouvenirController::class, 'update'])->name('souvenir.update'); // Update existing category
    Route::delete('souvenir/{id}', [ManageSouvenirController::class, 'destroy'])->name('souvenir.destroy'); // Delete category


    Route::get('/academy-souvenirs', [ManageSouvenirController::class, 'indexAcademySouvenirs'])->name('academy_souvenirs.index');
    Route::get('/academy-souvenirs/create', [ManageSouvenirController::class, 'createAcademySouvenir'])->name('academy_souvenirs.create');
    Route::post('/academy-souvenirs/store', [ManageSouvenirController::class, 'storeAcademySouvenir'])->name('academy_souvenirs.store');
    Route::get('/academy-souvenirs/edit/{id}', [ManageSouvenirController::class, 'editAcademySouvenir'])->name('academy_souvenirs.edit');
    Route::delete('/academy-souvenirs/destroy/{id}', [ManageSouvenirController::class, 'destroyAcademySouvenir'])->name('academy_souvenirs.destroy');
    Route::put('academy-souvenirs/update/{id}', [AcademySouvenirController::class, 'updateAcademySouvenir'])->name('academy_souvenirs.update');



    //view profile route
    Route::get('view-profile', [ViewprofileController::class, 'index'])->name('view-profile.index');

    //change password
    Route::get('change_password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('change_password');
    Route::post('change-password', [ChangePasswordController::class, 'updatePassword'])->name('update_password');


    //change souvenirs
    Route::get('/academy-souvenirs', [ManageSouvenirController::class, 'indexAcademySouvenirs'])->name('academy_souvenirs.index');
    Route::get('/academy-souvenirs/create', [ManageSouvenirController::class, 'createAcademySouvenir'])->name('academy_souvenirs.create');
    Route::post('/academy-souvenirs/store', [ManageSouvenirController::class, 'storeAcademySouvenir'])->name('academy_souvenirs.store');
    Route::get('/academy-souvenirs/edit/{id}', [ManageSouvenirController::class, 'editAcademySouvenir'])->name('academy_souvenirs.edit');
    Route::PUT('/academy-souvenirs/update/{id}', [ManageSouvenirController::class, 'updateAcademySouvenir'])->name('academy_souvenirs.update');
    Route::delete('/academy-souvenirs/destroy/{id}', [ManageSouvenirController::class, 'destroyAcademySouvenir'])->name('academy_souvenirs.destroy');

 
    // Manage organisation chart route
    Route::get('organisation_chart', [EmployeeController::class, 'organisation_chartIndex'])->name('organisation_chart.index');
    Route::get('organisation_chart/create', [EmployeeController::class, 'organisation_chartCreate'])->name('organisation_chart.create');
    Route::post('organisation_chart/store', [EmployeeController::class, 'organisation_chartStore'])->name('organisation_chart.store');
    Route::get('organisation_chart/{id}/edit', [EmployeeController::class, 'organisation_chartEdit'])->name('organisation_chart.edit');
    Route::post('organisation_chart/{id}/update', [EmployeeController::class, 'organisation_chartUpdate'])->name('organisation_chart.update');
    Route::post('organisation_chart/{id}/delete', [EmployeeController::class, 'organisation_chartDestroy'])->name('organisation-chart.destroy');
    Route::get('/autocomplete-employees', [EmployeeController::class, 'autocompleteEmployees'])->name('employee.autocomplete');
    // Add this route for the sub-organisation page
    // Route::get('organisation-chart/sub-org/{parent_id}', [EmployeeController::class, 'showSubOrg'])->name('organisation_chart.sub_org');
    Route::get('organisation-chart/sub-org/{parent_id}', [EmployeeController::class, 'showSubOrg'])->name('organisation-chart.sub-org');
    

    // manage course subcategory
    Route::get('subcategory', [CoursesubCategoryController::class, 'index'])->name('subcategory.index');
    Route::get('subcategory/create', [CoursesubCategoryController::class, 'create'])->name('subcategory.create');
    Route::post('subcategory/', [CoursesubCategoryController::class, 'store'])->name('subcategory.store');
    Route::get('subcategory/{id}/edit', [CoursesubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::put('subcategory/{id}', [CoursesubCategoryController::class, 'update'])->name('subcategory.update');
    Route::get('subcategory/{id}/delete', [CoursesubCategoryController::class, 'delete'])->name('subcategory.delete');

    // Indrajeet
    Route::resource('organisers', OrganiserController::class);
    Route::resource('venues', ManageVenueController::class);
    Route::resource('coordinators', CoordinatorController::class);
    Route::resource('founders', ManageFoundersController::class);
    Route::resource('cadres', ManageCadresController::class);
    Route::resource('manage_tender', ManageTenderController::class);
    Route::resource('manage_events', ManageEventsController::class);
    Route::get('/manage_events/{id}/edit', [ManageEventsController::class, 'edit'])->name('manage_events.edit');
    Route::put('/manage_events/{id}', [ManageEventsController::class, 'update'])->name('manage_events.update');
    Route::resource('media-center', ManageMediaCenterController::class);
    Route::put('admin/media-center/{id}', [ManageMediaCenterController::class, 'update'])->name('media-center.update');
    Route::resource('video_gallery', ManageVideoController::class);
    Route::resource('media-categories', ManageMediaCategoriesController::class);
    Route::resource('photo-gallery', ManagePhotoGalleryController::class);
    Route::delete('/photo-gallery/{id}', [ManagePhotoGalleryController::class, 'destroy'])->name('photo-gallery.destroy');
    Route::delete('/micro-photo-gallery/{id}', [MicroManagePhotoGalleryController::class, 'destroy'])->name('micro-photo-gallery.destroy');

    Route::get('search-courses', [ManageEventsController::class, 'searchCourses'])->name('search.courses');
    // In routes/web.php
    Route::get('/admin/get-course-details/{courseId}', [CourseController::class, 'getCourseDetails']);

    // Indrajeet



    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('news', NewsController::class);
        // Route::resource('faculty', FacultyMemberController::class);
    });


    // Indrajeet
    Route::resource('organisers', OrganiserController::class);
    Route::resource('coordinators', CoordinatorController::class);
    Route::resource('venues', ManageVenueController::class);
    Route::resource('founders', ManageFoundersController::class);
    Route::resource('cadres', ManageCadresController::class);

    Route::resource('manage_tender', ManageTenderController::class);
    Route::resource('manage_vacancy', ManageVacancyController::class);
    Route::get('/manage_vacancy/{id}/edit', [ManageVacancyController::class, 'edit'])->name('manage_vacancy.edit');
    Route::resource('manage_events', ManageEventsController::class);

    Route::get('/manage_events/{id}/edit', [ManageEventsController::class, 'edit'])->name('manage_events.edit');
    Route::put('/manage_events/{id}', [ManageEventsController::class, 'update'])->name('manage_events.update');
    Route::get('/manage-audit', [ManageAuditController::class, 'index'])->name('manage_audit.index');

    Route::get('/micro_manage_audit', [MicroManageAuditController::class, 'index'])->name('micro_manage_audit.index');

    

    // For Micro Website
    Route::resource('training-programs', TrainingProgramController::class);
    Route::resource('organization_setups', OrganizationSetupController::class);

    Route::resource('micro_manage_vacancy', MicroManageVacancyController::class);
    Route::put('/micro-manage-vacancy/{id}', [MicroManageVacancyController::class, 'update'])->name('micro_manage_vacancy.update');
    Route::get('/micro_manage_vacancy/{id}/edit', [MicroManageVacancyController::class, 'edit'])->name('micro_manage_vacancy.edit');
    // Route::delete('/admin/micro_manage_vacancy/{id}', [MicroManageVacancyController::class, 'destroy'])->name('micro_manage_vacancy.destroy');
 

    Route::resource('micro-video-gallery', MicroVideoGalleryController::class);
    Route::put('admin/micro-video-gallery/{id}', [MicroVideoGalleryController::class, 'update'])->name('micro-video-gallery.update');
    Route::get('admin/micro-video-gallery/{id}', [MicroVideoGalleryController::class, 'show']);

    Route::get('admin/micro-video-gallery/{id}', [MicroVideoGalleryController::class, 'show'])->name('micro-video-gallery.show');
    Route::get('admin/micro-video-gallery/{id}/edit', [MicroVideoGalleryController::class, 'edit'])->name('micro-video-gallery.edit');
    Route::put('admin/micro-video-gallery/{id}', [MicroVideoGalleryController::class, 'update'])->name('micro-video-gallery.update');
    Route::resource('micro-photo-gallery', MicroManagePhotoGalleryController::class);

    Route::resource('photovideogallery', MicroManageMediaCenterController::class);
    // Manage manage Research centre  route
    Route::get('researchcentres', [ManageResearchCentreController::class, 'researchcentresIndex'])->name('researchcentres.index');
    Route::get('researchcentres/create', [ManageResearchCentreController::class, 'researchcentresCreate'])->name('researchcentres.create');
    Route::post('researchcentres/store', [ManageResearchCentreController::class, 'researchcentresStore'])->name('researchcentres.store');
    Route::get('researchcentres/{id}/edit', [ManageResearchCentreController::class, 'researchcentresEdit'])->name('researchcentres.edit');
    Route::post('researchcentres/{id}/update', [ManageResearchCentreController::class, 'researchcentresUpdate'])->name('researchcentres.update');
    Route::post('researchcentres/{id}/delete', [ManageResearchCentreController::class, 'researchcentresDestroy'])->name('researchcentres.destroy');

    // Route::resource('micro-photo-gallery', MicroManagePhotoGalleryController::class);
    // Manage micro news route
    Route::resource('Managenews', ManageNewsController::class);

    //Manage micro Menu cms Page
    Route::get('/admin/micromenu', [MicroMenuController::class, 'index'])->name('micromenus.index');
    Route::get('/admin/micromenu/create', [MicroMenuController::class, 'create'])->name('micromenus.create');
    Route::post('/admin/micromenu', [MicroMenuController::class, 'store'])->name('micromenus.store');
    Route::get('/admin/micromenu/{id}/edit', [MicroMenuController::class, 'edit'])->name('micromenus.edit');
    Route::put('/admin/micromenu/{id}', [MicroMenuController::class, 'update'])->name('micromenu.update');
    Route::get('/admin/micromenu/{id}/delete', [MicroMenuController::class, 'delete'])->name('micromenu.delete');

    Route::post('/micromenu/{id}/toggle-status', [MicroMenuController::class, 'toggleStatus'])->name('micromenus.toggleStatus');

    //Manage micro Quick links Page

    Route::get('/microquick-links', [ManageQuickLinksController::class, 'quick_link_list'])->name('microquicklinks.index');
    Route::get('/microquick-links/create', [ManageQuickLinksController::class, 'quick_link_create'])->name('microquicklinks.create');
    Route::post('/microquick-links/store', [ManageQuickLinksController::class, 'quick_link_store'])->name('microquicklinks.store');
    Route::get('/microquick-links/{id}/edit', [ManageQuickLinksController::class, 'quick_link_edit'])->name('microquicklinks.edit');
    Route::put('/microquick-links/{id}', [ManageQuickLinksController::class, 'quick_link_update'])->name('microquicklinks.update');
    Route::delete('/microquick-links/{id}', [ManageQuickLinksController::class, 'quick_link_destroy'])->name('microquicklinks.destroy');
    
    Route::resource('slider', MicroSliderController::class);


});
// Indrajeet


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('courses', CourseController::class);


    // Route::prefix('admin')->name('admin.')->group(function() {
    //     Route::resource('news', NewsController::class);
    //     // Route::resource('faculty', FacultyMemberController::class);
    // });

});



Route::post('/admin/toggle-status', [MenuController::class, 'toggle_status'])->name('admin.toggle-status');

});

// login wrok here mayank
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/refresh_captcha',[LoginController::class, 'refreshCaptcha'])->name('refresh_captcha');
Route::post('/admin/login', [LoginController::class, 'authenticate'])->name('admin.login');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');


