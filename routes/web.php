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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/comptable/{accountantId?}/visiteurs', 'Accountant\ExpenseSheetController@visitors')->name('visiteurs.liste');

Route::get('/comptable/{accountantId?}/visiteur/{visitorId?}/fiches', 'Accountant\ExpenseSheetController@sheets')
    ->name('visiteur.fiches.liste');

Route::get('/comptable/{accountantId?}/visiteur/{visitorId?}/fiche/{sheetId?}', 'Accountant\ExpenseSheetController@show')
    ->name('visiteur.fiche.afficher');

Route::get('/comptable/{accountantId?}/visiteur/{visitorId?}/fiche/{sheetId?}/valider', 'Accountant\ExpenseSheetController@confirm')
    ->name('visiteur.fiche.valider');

Route::get('/comptable/{accountantId?}/visiteur/{visitorId?}/fiche/{sheetId?}/remboursee', 'Accountant\ExpenseSheetController@refunded')
    ->name('visiteur.fiche.remboursee');

Route::get('/comptable/{accountantId?}/visiteur/{visitorId?}/fiche/{sheetId?}/frais-forfait/{expenseId?}/editer',
    'Accountant\FixedExpenseRowController@edit')
    ->name('visiteur.frais.forfait.editer');

Route::post('/comptable/{accountantId?}/visiteur/{visitorId?}/fiche/{sheetId?}/frais-forfait/{expenseId?}/editer',
    'Accountant\FixedExpenseRowController@update')
    ->name('visiteur.frais.forfait.editer');

Route::get('/comptable/{accountantId?}/visiteur/{visitorId?}/fiche/{sheetId?}/hors-forfait/{expenseId?}/refuser',
    'Accountant\NonFixedExpenseRowController@refuse')
    ->name('visiteur.frais.hors.forfait.refuser');

Route::get('/comptable/{accountantId?}/visiteur/{visitorId?}/fiche/{sheetId?}/hors-forfait/{expenseId?}/reporter',
    'Accountant\NonFixedExpenseRowController@postpone')
    ->name('visiteur.frais.hors.forfait.reporter');

Route::get('/comptable/{accountantId?}/fiches/cloturer', 'Accountant\ExpenseSheetController@closeAll')->name('cloturer.fiches');

Route::get('/visiteur/{userId?}/fiche/{sheetId?}/frais/{expenseId?}/supprimer', 'Visitor\NonFixedExpenseRowController@destroy')
    ->name('frais.hors.forfait.supprimer');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/visiteur/{userId?}/fiches', 'Visitor\ExpenseSheetController@index')->name('fiches.liste');

Route::get('/visiteur/{userId?}/fiche/ajout', 'Visitor\ExpenseSheetController@edit')->name('ajout.frais');

Route::get('/visiteur/{userId?}/fiche/{sheetId?}', 'Visitor\ExpenseSheetController@show')->name('fiche.frais');

Route::get('/visiteur/{userId?}/fiche/{sheetId?}/pdf', 'Visitor\ExpenseSheetController@pdf')->name('fiche.frais.pdf');

Route::post('/visiteur/{userId?}/fiche/{sheetId?}/frais/forfait/ajout', 'Visitor\FixedExpenseRowController@store')
    ->name('frais.forfait.ajout');

Route::post('/visiteur/{userId?}/fiche/{sheetId?}/frais/hors-forfait/ajout', 'Visitor\NonFixedExpenseRowController@store')
    ->name('frais.hors.forfait.ajout');
