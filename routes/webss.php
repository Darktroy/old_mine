<?php
//|----------------------------------------------------------------|
//|                     Site Main Routes                           |
//|----------------------------------------------------------------|
Route::get('/', 'Site\HomeController@index');
Route::post('/home/contact_us', 'Site\HomeController@contactUs');
Route::get('/faq', 'Common\FaqController@homeFaq');
Route::get('/faq/{category}', 'Common\FaqController@getCategoryQuestions');
// About Us Routes

//  Ideas
Route::get('/about-us/idea', 'Common\AboutUsController@idea');
Route::get('/about-us/idea/{id}', 'Common\AboutUsController@getIdea');
//  Themes
Route::get('/about-us/themes', 'Common\AboutUsController@themes');
Route::get('/about-us/themes/{id}', 'Common\AboutUsController@getTheme');
//  Forums
Route::get('/about-us/forums', 'Common\AboutUsController@forums');
Route::get('/about-us/forums/{id}', 'Common\AboutUsController@getForum');
//  GeoLocation
Route::get('/about-us/geolocation', 'Common\AboutUsController@geoLocation');
//  Label
Route::get('/about-us/label', 'Common\AboutUsController@label');

//  Blog

//  All Posts
Route::get('blog/category/{title}', 'Common\Blog\CategoriesController@viewCategory');
Route::get('/blog/posts', 'Common\Blog\BlogController@index');
Route::get('/blog/posts/{title}', 'Common\Blog\PostsController@viewPost');

Route::get('user/login', 'Auth\LoginController@getLoginView');
Route::post('user/login', 'Auth\LoginController@validateUser');

// Calls View On Site
Route::get('/calls', 'Common\CallsController@viewCallsInSite');
Route::post('/calls/filter', 'Common\CallsController@filterCalls');
Route::get('/calls/view/{id}', 'Common\CallsController@viewCallInSite');

// Offers View On Site
Route::get('/offers', 'Common\OffersController@viewOffersInSite');
Route::get('/offers/view/{id}', 'Common\OffersController@viewSingleOfferInSite');
Route::post('/offers/filter', 'Common\OffersController@filterOffers');
Route::get('/list-offer_types', 'Common\OffersController@listOfferTypes');
Route::get('/offers/sectors', 'Common\OffersController@getSectors');
Route::get('offers/country/{country}', 'Common\OffersController@indexCountryOffers');


//Get Countries
Route::get('countries/country/{id}', 'Common\CountriesController@viewCountry');
Route::get('countries/{letter}', 'Common\CountriesController@getCountriesByFirstLetter');
Route::get('countries', 'Common\CountriesController@index')->name('countries');


// Get Country Cities
Route::get('/countries/getcities/{id}', 'Common\CountriesController@getCities');
// List All Cities
Route::get('/list-countries', 'Common\CountriesController@listCountriesAjax');
Route::get('/countries/invitations', 'Common\CountriesController@invitations');

//invitation
Route::get('invite/invitations','Common\InvitationController@invitations');
Route::post('invite/invite-save','Common\InvitationController@saveInvitation');
Route::get('invite/invite-app','Common\InvitationController@inviteApplication');
Route::post('country/application','Common\InvitationController@saveCountryApplication');

Route::get('countries/index', 'Common\CountriesController@index');
Route::get('countries/{letter}', 'Common\CountriesController@getCountriesByFirstLetter');
Route::get('countries/country/{id}', 'Common\CountriesController@viewCountry');

//|----------------------------------------------------------------|
//|                     Admin Routes                               |
//|----------------------------------------------------------------|
Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/panel', 'Panel\PanelController@panelDashboard')->name('dashboard');
    Route::get('/panel/admin/settings', 'Panel\PanelController@getAdminSettings');
    Route::post('/panel/admin/settings', 'Panel\PanelController@updateAdminSettings');

    //    Site Config Routes

    Route::get('/panel/admin/site-config', 'Common\SiteConfigController@index');
    Route::post('/panel/admin/site-config', 'Common\SiteConfigController@storeConfig');

    // Sponsers Routes

    Route::get('/panel/sponsers', 'Common\SponsersController@index')->name('sponsers');
    Route::get('/panel/sponsers/new', 'Common\SponsersController@newSponser');
    Route::post('/panel/sponsers/new', 'Common\SponsersController@createSponser');
    Route::get('/panel/sponsers/{id}/edit', 'Common\SponsersController@editSponser');
    Route::post('/panel/sponsers/{id}/edit', 'Common\SponsersController@updateSponser');
    Route::post('/panel/sponsers/{id}/delete', 'Common\SponsersController@deleteSponser');

    //    Home Routes

    //    Home Slider Routes
    Route::get('panel/home/slider', 'Common\SliderController@index')->name('slider');
    Route::get('panel/home/slider/new', 'Common\SliderController@newSlide');
    Route::post('panel/home/slider/new', 'Common\SliderController@storeSlide');
    Route::get('panel/home/slider/{id}/edit', 'Common\SliderController@editSlide');
    Route::post('panel/home/slider/{id}/edit', 'Common\SliderController@updateSlide');
    Route::post('panel/home/slider/{id}/imageDelete', 'Common\SliderController@deleteSlideImage');

    //    Get all messages
    Route::get('panel/home/contact_us', 'Panel\PanelController@getContactUsMessages')->name('contactUs');
    //    Get One Message
    Route::get('panel/home/contact_us/{id}', 'Panel\PanelController@getContactUsMessage');
    //    Delete One Message
    Route::post('panel/home/contact_us/{id}/delete', 'Panel\PanelController@deleteContactUsMessage');
    //    Delete All Messages
    Route::post('panel/home/contact_us/messages/delete', 'Panel\PanelController@deleteContactUsMessages');

    //  About Us Routes

    //  Ideas
    Route::get('panel/about_us/idea', 'Panel\AboutUs\IdeasController@index')->name('ideas');
    Route::get('panel/about_us/idea/new', 'Panel\AboutUs\IdeasController@newIdea');
    Route::post('panel/about_us/idea/new', 'Panel\AboutUs\IdeasController@createIdea');
    Route::get('panel/about_us/idea/{id}', 'Panel\AboutUs\IdeasController@getIdea');
    Route::get('panel/about_us/idea/{id}/edit', 'Panel\AboutUs\IdeasController@editIdea');
    Route::post('panel/about_us/idea/{id}/edit', 'Panel\AboutUs\IdeasController@updateIdea');
    Route::post('panel/about_us/idea/{id}/delete', 'Panel\AboutUs\IdeasController@deleteIdea');

    //  Themes
    Route::get('panel/about_us/themes', 'Panel\AboutUs\ThemesController@index')->name('themes');
    Route::get('panel/about_us/themes/new', 'Panel\AboutUs\ThemesController@newTheme');
    Route::post('panel/about_us/themes/new', 'Panel\AboutUs\ThemesController@createTheme');
    Route::get('panel/about_us/themes/{id}', 'Panel\AboutUs\ThemesController@getTheme');
    Route::get('panel/about_us/themes/{id}/edit', 'Panel\AboutUs\ThemesController@editTheme');
    Route::post('panel/about_us/themes/{id}/edit', 'Panel\AboutUs\ThemesController@updateTheme');
    Route::post('panel/about_us/themes/{id}/delete', 'Panel\AboutUs\ThemesController@deleteTheme');

    //  Forums
    Route::get('panel/about_us/forums', 'Panel\AboutUs\ForumsController@index')->name('forums');
    Route::get('panel/about_us/forums/new', 'Panel\AboutUs\ForumsController@newForum');
    Route::post('panel/about_us/forums/new', 'Panel\AboutUs\ForumsController@createForum');
    Route::get('panel/about_us/forums/{id}', 'Panel\AboutUs\ForumsController@getForum');
    Route::get('panel/about_us/forums/{id}/edit', 'Panel\AboutUs\ForumsController@editForum');
    Route::post('panel/about_us/forums/{id}/edit', 'Panel\AboutUs\ForumsController@updateForum');
    Route::post('panel/about_us/forums/{id}/delete', 'Panel\AboutUs\ForumsController@deleteForum');

    // Geo Location
    Route::get('panel/about_us/geo', 'Common\AboutUsController@viewPanelGeoForm');

    // Label
    Route::get('panel/about_us/labels', 'Panel\AboutUs\LabelsController@index')->name('labels');
    Route::get('panel/about_us/labels/new', 'Panel\AboutUs\LabelsController@newLabel');
    Route::post('panel/about_us/labels/new', 'Panel\AboutUs\LabelsController@createLabel');
    Route::get('panel/about_us/labels/{id}/edit', 'Panel\AboutUs\LabelsController@editLabel');
    Route::post('panel/about_us/labels/{id}/edit', 'Panel\AboutUs\LabelsController@updateLabel');
    Route::post('panel/about_us/labels/{id}/delete', 'Panel\AboutUs\LabelsController@deleteLabel');

    //Application admin
    Route::get('panel/application/index', 'Panel\ApplicationsController@index');
    Route::get('panel/application/view/{id}', 'Panel\ApplicationsController@view');
    Route::post('panel/application/delete/{id}', 'Panel\ApplicationsController@delete');
    Route::post('panel/application/edit/{id}', 'Panel\ApplicationsController@edit');
    Route::get('panel/application/country/{litter}/search', 'Panel\ApplicationsController@getCountriesByFirstLetter');

    //    FAQ
    Route::get('panel/faq', 'Common\FaqController@index')->name('faq');
    Route::get('panel/faq/new', 'Common\FaqController@newQuestion');
    Route::post('panel/faq/new', 'Common\FaqController@storeQuestion');
    Route::get('panel/faq/{id}/edit', 'Common\FaqController@editQuestion');
    Route::post('panel/faq/{id}/edit', 'Common\FaqController@updateQuestion');
    Route::post('panel/faq/{id}/delete', 'Common\FaqController@deleteQuestion');

    //  Blog
    //  Categories
    Route::get('panel/blog/categories', 'Common\Blog\CategoriesController@index')->name('categories');
    Route::get('panel/blog/categories/new', 'Common\Blog\CategoriesController@newCategory');
    Route::post('panel/blog/categories/new', 'Common\Blog\CategoriesController@storeCategory');
    Route::get('panel/blog/categories/{id}/edit', 'Common\Blog\CategoriesController@editCategory');
    Route::post('panel/blog/categories/{id}/edit', 'Common\Blog\CategoriesController@updateCategory');
    Route::post('panel/blog/categories/{id}/delete', 'Common\Blog\CategoriesController@deleteCategory');

    //  Posts
    Route::get('panel/blog/posts', 'Common\Blog\PostsController@index')->name('posts');
    Route::get('panel/blog/posts/new', 'Common\Blog\PostsController@newPost');
    Route::post('panel/blog/posts/new', 'Common\Blog\PostsController@storePost');
    Route::get('panel/blog/posts/{id}/edit', 'Common\Blog\PostsController@editPost');
    Route::post('panel/blog/posts/{id}/edit', 'Common\Blog\PostsController@updatePost');
    Route::post('panel/blog/posts/{id}/delete', 'Common\Blog\PostsController@deletePost');
    Route::post('panel/blog/posts/images/{id}/delete', 'Common\Blog\PostsController@deletePostImage');
    Route::get('panel/blog/category/posts/{id}', 'Common\Blog\PostsController@getCategoryPosts');


    // Countries
    Route::get('panel/countries', 'Common\CountriesController@index')->name('countries');
    Route::get('panel/countries/{letter}', 'Common\CountriesController@getCountriesByFirstLetter');
    Route::get('panel/countries/country/{id}', 'Common\CountriesController@viewCountry');
    Route::post('panel/countries/country/{id}', 'Common\CountriesController@updateCountry');

    // Citites
    Route::get('panel/cities', 'Common\CitiesController@index')->name('cities');
    Route::get('panel/cities/new', 'Common\CitiesController@newCity');
    Route::post('panel/cities/new', 'Common\CitiesController@storeCity');
    Route::get('panel/cities/edit/{id}', 'Common\CitiesController@editCity');
    Route::post('panel/cities/edit/{id}', 'Common\CitiesController@updateCity');
    Route::post('panel/cities/delete/{id}', 'Common\CitiesController@deleteCity');

    // Calls
    Route::get('panel/calls', 'Common\CallsController@adminListAllCalls')->name('panel.calls');
    Route::get('panel/calls/{id}/view', 'Common\CallsController@viewCall');
    // New Call
    Route::get('panel/calls/new', 'Common\CallsController@adminNewCall');
    Route::post('panel/calls/new', 'Common\CallsController@storeCall');
    // Edit Calls
    Route::get('panel/calls/{id}/edit', 'Common\CallsController@editCall');
    Route::post('panel/calls/{id}/edit', 'Common\CallsController@updateCall');
    // Calls Status (Accepted Or Rejected)
    Route::get('panel/calls/{id}/status/{status}', 'Common\CallsController@callStatus');
    // Calls Activation(Active Or Not)
    Route::get('panel/calls/{id}/activation/{active}', 'Common\CallsController@callActivation');
    Route::post('panel/calls/{id}/delete', 'Common\CallsController@deleteCall');
    Route::get('panel/calls/new/get-country-cities', 'Common\CountriesController@getCities');
    Route::get('panel/calls/{id}', 'Common\CallsController@getCall');

    // Offers
    Route::get('panel/offers/', 'Common\OffersController@index')->name('panel.offers');
    Route::get('panel/offers/{id}/view', 'Common\OffersController@viewOffer');
    Route::get('panel/offers/new', 'Common\OffersController@adminNewOffer');
    Route::post('panel/offers/new', 'Common\OffersController@storeOffer');

    Route::get('panel/offers/{id}/edit', 'Common\OffersController@editOffer');
    Route::post('panel/offers/{id}/edit', 'Common\OffersController@updateOffer');
    Route::post('panel/offers/{id}/delete', 'Common\OffersController@deleteOffer');

    // Offer Status (Accepted Or Rejected)
    Route::get('panel/offers/{id}/status/{status}', 'Common\OffersController@offerStatus');
    // Offer Activation(Active Or Not)
    Route::get('panel/offers/{id}/activation/{active}', 'Common\OffersController@offerActivation');

});

//|----------------------------------------------------------------|
//|                     Country Routes                             |
//|----------------------------------------------------------------|
Route::group(['middleware' => ['country']], function () {
    Route::get('countries', 'Common\CountriesController@index')->name('countries');
    Route::get('/country/account', 'Common\CountriesController@countryAccount');
    Route::post('account/update/{id}', 'Common\CountriesController@updateCountry');


    Route::post('country/settings/check-user-password/', 'Common\UsersController@validatePassword');
    Route::post('country/settings/change-password', 'Common\UsersController@changePassword');

    //    Topics
  //  Route::group(['middleware' => ['role:topics']], function () {
        Route::get('country/topics', 'Common\CountriesController@listTopics');
        Route::get('country/topics/new', 'Common\CountriesController@newTopic');
        Route::post('country/topics/new', 'Common\Blog\PostsController@storePost');
        Route::get('country/topics/edit/{id}', 'Common\CountriesController@editTopic');
        Route::post('country/topics/edit/{id}', 'Common\Blog\PostsController@updatePost');
        Route::post('country/topics/{id}/delete', 'Common\Blog\PostsController@deletePost');
        Route::post('country/topics/images/{id}/delete', 'Common\Blog\PostsController@deletePostImage');
 //   });

//    Country News
  //  Route::group(['middleware' => ['role:news']], function () {
        Route::get('country/news', 'Common\CountriesController@listNews');
        Route::get('country/news/new', 'Common\CountriesController@newNews');
        Route::post('country/news/new', 'Common\NewsController@storeNews');
        Route::get('country/news/edit/{id}', 'Common\CountriesController@editNews');
        Route::post('country/news/edit/{id}', 'Common\NewsController@updateNews');
        Route::post('country/news/{id}/delete', 'Common\NewsController@deleteNews');
 //   });

    //  Country Agreements
 //   Route::group(['middleware' => ['role:agreements']], function () {
        Route::get('country/agreements', 'Common\CountriesController@listAgreements');
        Route::get('country/agreements/new', 'Common\CountriesController@newAgreement');
        Route::post('country/agreements/new', 'Common\AgreementsController@storeAgreement');
        Route::get('country/agreements/{id}/edit', 'Common\CountriesController@editAgreement');
        Route::post('country/agreements/{id}/edit', 'Common\AgreementsController@updateAgreement');
        Route::post('country/agreements/{id}/delete', 'Common\AgreementsController@deleteAgreement');
  //  });
   // Route::group(['middleware' => ['role:events']], function () {
        //  Country Events
        Route::get('country/events', 'Common\CountriesController@listEvents');
        Route::get('country/events/new', 'Common\CountriesController@newEvent');
        Route::post('country/events/new', 'Common\EventsController@storeEvent');
        Route::get('country/events/{id}/edit', 'Common\CountriesController@editEvent');
        Route::post('country/events/{id}/edit', 'Common\EventsController@updateEvent');
        Route::post('country/events/{id}/delete', 'Common\EventsController@deleteEvent');

  //  });


    //  Country Calls
   // Route::group(['middleware' => ['role:calls']], function () {
        Route::get('country/calls', 'Common\CountriesController@viewAllCalls')->name('country.calls');
        Route::get('country/calls/{id}/view', 'Common\CallsController@viewCall');
        // New Call
        Route::get('/country/calls/new', 'Common\CountriesController@newCall');
        Route::post('/country/calls/new', 'Common\CallsController@storeCall');
        // Edit Calls
        Route::get('country/calls/{id}/edit', 'Common\CountriesController@editCall');
        Route::post('country/calls/{id}/edit', 'Common\CallsController@updateCall');
        // Calls Status (Accepted Or Rejected)
        // Route::get('country/calls/{id}/status/{status}', 'Common\CallsController@callStatus');
        // Calls Activation(Active Or Not)
        // Route::get('country/calls/{id}/activation/{active}', 'Common\CallsController@callActivation');
        Route::post('country/calls/{id}/delete', 'Common\CallsController@deleteCall');
        Route::get('country/calls/new/get-country-cities', 'Common\CountriesController@getCities');
        Route::get('country/calls/{id}', 'Common\CallsController@getCall');
   // });

    //  Country Offers
   // Route::group(['middleware' => ['role:offers']], function () {
        Route::get('country/offers/', 'Common\CountriesController@viewAllOffers')->name('country.offers');
        Route::get('country/offers/{id}/view', 'Common\CountriesController@viewOffer');
        Route::get('country/offers/new', 'Common\CountriesController@newOffer');
        Route::post('country/offers/new', 'Common\OffersController@storeOffer');

        Route::get('country/offers/{id}/edit', 'Common\CountriesController@editOffer');
        Route::post('country/offers/{id}/edit', 'Common\OffersController@updateOffer');
        Route::post('country/offers/{id}/delete', 'Common\OffersController@deleteOffer');
        // Offer Status (Accepted Or Rejected)
        Route::get('country/offers/{id}/status/{status}', 'Common\OffersController@offerStatus');
        // Offer Activation(Active Or Not)
        Route::get('country/offers/{id}/activation/{active}', 'Common\OffersController@offerActivation');
  //  });

    // Country Users
    Route::group(['middleware' => ['role:sub-users']], function () {
        Route::get('country/users', 'Common\CountriesController@listAllUsers');
        Route::get('country/users/new', 'Common\CountriesController@newUser');
        Route::post('country/users/new', 'Common\SubUsersController@storeUser');
        Route::get('country/users/edit/{id}', 'Common\CountriesController@editUser');
        Route::post('country/users/edit/{id}', 'Common\SubUsersController@updateUser');
        Route::post('country/users/{id}/delete', 'Common\SubUsersController@deleteUser');
    });
    Route::get('country/account/{id}', 'Common\SubUsersController@viewAccount');

});


//|----------------------------------------------------------------|
//|                     ChangeMaker Routes                         |
//|----------------------------------------------------------------|
// Change Makers
// Registers
Route::get('/changemakers/register', 'Common\ChangemakersController@newChangemaker');
Route::post('/changemakers/register', 'Common\ChangemakersController@storeChangemaker');
Route::group(['middleware' => ['changemaker']], function () {
    Route::get('/changemaker/account', 'Common\ChangemakersController@changeMakerAccount')->name('changemaker');
    Route::post('/changemaker/account', 'Common\ChangemakersController@updateChangeMakerAccount');
    Route::post('changemaker/settings/check-user-password', 'Common\UsersController@validatePassword');
    Route::post('changemaker/settings/change-password', 'Common\UsersController@changePassword');

});


//|----------------------------------------------------------------|
//|                     Company Routes                             |
//|----------------------------------------------------------------|
// Company Register
Route::get('company/register', 'Common\CompanyController@register');
Route::post('company/register', 'Common\CompanyController@storeCompany');
Route::group(['middleware' => ['company']], function () {
    Route::get('company/account', 'Common\CompanyController@companyAccount')->name('company');
    Route::post('company/account', 'Common\CompanyController@updateCompany');
    Route::get('company/settings', 'Common\CompanyController@updateCompany');
    Route::post('company/settings/check-user-password/', 'Common\UsersController@validatePassword');
    Route::post('company/settings/change-password', 'Common\UsersController@changePassword');

    // Calls
    Route::get('company/calls', 'Common\CompanyController@viewCalls');
    Route::get('company/calls/new', 'Common\CompanyController@newCall');
    Route::get('calls/new/get-country-cities', 'Common\CountriesController@getCities');
    Route::post('company/calls/new', 'Common\CallsController@storeCall');
//    filter
    Route::get('company/calls/filter/{type}', 'Common\CallsController@callsOwnerFilter');

});


//|----------------------------------------------------------------|
//|                     partners Routes                            |
//|----------------------------------------------------------------|
// Company Register
Route::get('/partners/register', 'Common\PartnersController@registerPartner');


Route::group(['middleware' => ['auth']], function () {
    Route::post('/invite-friend','Common\GeneralController@inviteFriend');
});

// Auth Routes
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');