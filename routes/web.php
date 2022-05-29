<?php

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

Auth::routes(['verify' => true]);

Route::redirect('/', 'login');
Route::redirect('/home', 'dashboard');

//Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['verified'])->group(function () {
    Route::get('/dashboard', 'JobSeekerController@dashboard')->name('dashboard');
    Route::get('/update/my/cv', 'JobSeekerController@CVUpdateForm')->name('CVUpdateForm');
    Route::get('/update/my/cv#eduinfo', 'JobSeekerController@CVUpdateForm')->name('CVUpdateFormEduinfo');
    Route::post('/update/personal/info', 'JobSeekerController@PersonalInfoUpdate')->name('PersonalInfoUpdate');

    Route::post('/add/education/info', 'JobSeekerController@AddEducation')->name('AddEducation');
    Route::post('/update/education/info', 'JobSeekerController@EducationUpdate')->name('EducationUpdate');
    Route::get('/delete/education/info/{id}', 'JobSeekerController@EducationDelete')->name('EducationDelete');
    Route::post('/add/training/info', 'JobSeekerController@AddTraining')->name('AddTraining');
    Route::post('/update/training/info', 'JobSeekerController@TrainingUpdate')->name('TrainingUpdate');
    Route::get('/delete/training/info/{id}', 'JobSeekerController@TrainingDelete')->name('TrainingDelete');
    Route::post('/add/job-objective', 'JobSeekerController@JobObjectivePost')->name('JobObjectivePost');
    Route::post('/add/job-objective/update', 'JobSeekerController@JobObjectiveUpdate')->name('JobObjectiveUpdate');
    Route::post('/add/job-skill', 'JobSeekerController@JobSkillPost')->name('JobSkillPost');
    Route::get('/delete/job-skill/{id}', 'JobSeekerController@JobSkillDelete')->name('JobSkillDelete');
    Route::post('/add/job-experience', 'JobSeekerController@JobExperiencePost')->name('JobExperiencePost');
    Route::post('/update/job-experience', 'JobSeekerController@JobExperienceUpdate')->name('JobExperienceUpdate');
    Route::get('/delete/job-experience/{id}', 'JobSeekerController@ExperienceDelete')->name('ExperienceDelete');
    Route::get('/cv-profile', 'JobSeekerController@CVPreview')->name('CVPreview');
    Route::get('/api/get-upazila-list/{id}', 'JobSeekerController@UpazilaList')->name('UpazilaList');
    Route::get('/api/get-pupazila-list/{id}', 'JobSeekerController@PUpazilaList')->name('PUpazilaList');
    Route::post('/add/portfolio', 'JobSeekerController@PortfolioPost')->name('PortfolioPost');
    Route::get('/delete/portfolio/{id}', 'JobSeekerController@PortfolioDelete')->name('PortfolioDelete');
    Route::post('/add/marketplace', 'JobSeekerController@MarketplacePost')->name('MarketplacePost');
    Route::get('/delete/marketplace/{id}', 'JobSeekerController@MarketplaceDelete')->name('MarketplaceDelete');
    Route::get('/api/get-title-list/{id}', 'JobSeekerController@GetDegreeTitle')->name('GetDegreeTitle');

    Route::get('/change/password', 'JobSeekerController@PasswordChange')->name('PasswordChange');
    Route::post('/change/password/update', 'JobSeekerController@PasswordUpdate')->name('PasswordUpdate');
    Route::get('/update/profile-photo', 'JobSeekerController@ProfilePhoto')->name('ProfilePhoto');
    Route::post('/update/profile-photo', 'JobSeekerController@ProfileImagePost')->name('ProfileImagePost');

    Route::get('/my-cv/live-preview', 'JobSeekerController@LivePreview')->name('LivePreview');
    Route::get('/view/my-cv/pdf-download', 'JobSeekerController@pdfDownload')->name('pdfDownload');
    Route::get('/job-topic', 'JobSeekerController@jobTopic')->name('jobTopic');
    Route::post('/update/job-subject', 'JobSeekerController@subjectUpdate')->name('subjectUpdate');

    Route::post('/mail/job/seeker', 'AdminController@mailjobseeker')->name('MailJobSeeker');
    Route::get('/admin/individual-cv/{p_id}', 'AdminController@IndividualCV')->name('IndividualCV');
    Route::post('/add/to/cv/request', 'AdminController@addtocvrequest')->name('AddToCVRequest');
    Route::get('/admin/all-cv-list', 'AdminController@AllCVList')->name('AllCVList');
    Route::get('/admin/search', 'AdminController@SearchSeeker')->name('SearchSeeker');
    Route::post('/search-job-seeker', 'AdminController@SearchResult')->name('SearchResult');
    Route::get('/admin/dashboard', 'AdminController@dashboard')->name('AdminDashboard');
    Route::get('/admin/cv-requested', 'HomeController@employerRequested')->name('employerRequested');
    Route::get('/admin/cv-requested/details/{cv_request_id}', 'HomeController@employerRequestedDetails')->name('employerRequestedDetails');
    Route::get('/admin/cv-requested/send', 'HomeController@sendCV')->name('sendCV');
    Route::get('/job/status/change/{id}', 'JobSeekerController@JobStatusChange')->name('JobStatusChange');
//    Employer Route
    Route::get('/company/profile', 'EmployerController@CompanyProfile')->name('CompanyProfile');
    Route::get('/employer/dashboard', 'EmployerController@employer')->name('employerDashboard');
    Route::post('/employer/dashboard/cvRequest', 'EmployerController@cvRequest')->name('cvRequest');
    Route::post('/employer/company/update', 'EmployerController@CompanyUpdate')->name('CompanyUpdate');
    Route::post('/employer/industry/update', 'EmployerController@IndustryUpdate')->name('IndustryUpdate');
    Route::post('/employer/contact/update', 'EmployerController@ContactUpdate')->name('ContactUpdate');
    Route::get('/employer/profile-photo', 'EmployerController@EmployerPhoto')->name('EmployerPhoto');
    Route::post('/employer/profile-photo', 'EmployerController@EmployerImagePost')->name('EmployerImagePost');
    Route::get('/company/api/get-upazila-list/{id}', 'EmployerController@CompanyList')->name('CompanyList');


    Route::get('/admin/skill', 'AdminController@Skills')->name('Skills');
    Route::post('/admin/skill/post', 'HomeController@SkillPost')->name('SkillPost');
    Route::get('/admin/skill/delete/{id}', 'HomeController@SkillDelete')->name('SkillDelete');
    Route::post('/admin/skill/update', 'HomeController@SkillUpdate')->name('SkillUpdate');

});
Route::get('/test', 'TestController@test')->name('test');
