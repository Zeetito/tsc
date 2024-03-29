<?php

use App\Models\User;
use App\Models\Conference;
use App\Models\Participant;
use App\Models\ConferenceUser;
use App\Models\SpecialParticipant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ConferenceUserController;
use App\Http\Controllers\SpecialParticipantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

    Route::get('/hello', function () {

        
        // // $conference = Conference::active_conference();
        // $participants = SpecialParticipant::select('participant_id')->groupBy('participant_id')->havingRaw('COUNT(*) > 1')->get();
        // // return (auth()->user()->paid_status_set_for($conference));
        // return $participants;
        
        // return User::find(1)->participants_for(Conference::find(1));

        $conferenceUser = ConferenceUser::where('user_id',2)->where('conference_id',1)->first();
        // return $conferenceUser;
        $conference = Conference::find(1);
        return $conference->special_participants_for(User::find(1));
        return Participant::whereBelongsTo($conference)->where('participants.paid',1)->where('participants.amount','>=',$conferenceUser->amount)->get()->intersect($conference->user->participants);

    });


    // SPECIAL PARTICIPANTS
    // Index
    Route::get('special_participants/{conference}',[SpecialParticipantController::class,'index'])
    ->middleware('auth')
    ->name('special_participants');

    // Create
    Route::get('create_special_participant/{user}/{conference}',[SpecialParticipantController::class,'create'])
    ->middleware('auth')
    ->name('create_special_participant');

    // Store
    Route::post('store_special_participant/{user}/{conference}',[SpecialParticipantController::class,'store'])
    ->middleware('auth')
    ->name('store_special_participant');

    // Confirm Delete
    Route::get('confirm_special_participant_delete/{specialParticipant}',[SpecialParticipantController::class,'confirm_delete'])
    ->middleware('auth')
    ->name('confirm_special_participant_delete');

    // Delete
    Route::delete('delete_special_participant/{specialParticipant}',[SpecialParticipantController::class,'delete'])
    ->middleware('auth')
    ->name('delete_special_participant');


// PARTICIPANTS

    // Create Participants
    Route::get('create_participant/{user}/{conference}',[ParticipantController::class,'create'])
    ->middleware('auth','paid_status')
    ->name('create_participant');
    
    // Store Participants
    Route::post('store_participant/{user}/{conference}',[ParticipantController::class,'store'])
    ->middleware('auth','paid_status')
    ->name('store_participant');

    // Confirm Delete
    Route::get('confirm_participant_delete/{participant}',[ParticipantController::class,'confirm_delete'])
    ->middleware('auth','paid_status')
    ->name('confirm_participant_delete');

    // Store Participants
    Route::delete('delete_participant/{participant}',[ParticipantController::class,'delete'])
    ->middleware('auth','paid_status')
    ->name('delete_participant');

    // Edit Participant
    Route::get('edit_participant/{participant}',[ParticipantController::class,'edit'])
    ->middleware('auth','paid_status')
    ->name('edit_participant');

    // Update Participant
    Route::put('update_participant/{participant}',[ParticipantController::class,'update'])
    ->middleware('auth','paid_status')
    ->name('update_participant');

    // Edit Bulk participants residence
    Route::get('edit_bulk_participant_residence/{user}/{conference}',[ParticipantController::class,'bulk_residence_edit'])
    ->middleware('auth','paid_status')
    ->name('edit_bulk_participant_residence');

    // Update Bulk residence
    Route::put('update_bulk_participant_residence/{user}/{conference}',[ParticipantController::class,'bulk_residence_update'])
    ->middleware('auth','paid_status')
    ->name('update_bulk_participant_residence');






// CONFERENCE

    // Create Conference
    Route::get('create_conference',[ConferenceController::class,'create'])
    ->middleware('auth')
    ->name('create_conference');

    // Store Conference
    Route::post('store_conference',[ConferenceController::class,'store'])
    ->middleware('auth')
    ->name('store_conference');

    // Show Conference
    Route::get('show_conference/{conference}',[ConferenceController::class,'show'])
    ->middleware('auth')
    ->name('show_conference');

    // Join Business
    Route::get('conference_join/{user}/{conference}',[ConferenceUserController::class,'join'])
    ->middleware('auth')
    ->name('conference_join');

    // View All Participants for all conference
    Route::get('conference_participants/{conference}',[ConferenceController::class,'participants'])
    ->middleware('auth','paid_status')
    ->name('conference_participants');



Auth::routes();

    // USER OR CAMPUS

    // View User Participants
    Route::get('user_participants/{user}/{conference}',[UserController::class,'participants'])
    ->middleware('auth')
    ->name('user_participants');

    // Confirm Exit Conference
    Route::get('confirm_exit_conference/{user}/{conference}',[UserController::class,'confirm_exit_conference'])
    ->middleware('auth')
    ->name('confirm_exit_conference');

    // Exit Conference
    Route::delete('exit_conference/{user}/{conference}',[UserController::class,'exit_conference'])
    ->middleware('auth')
    ->name('exit_conference');

    // Transfer Host Confirm
    Route::get('transfer_host_confirm',[UserController::class,'transfer_host_confirm'])
    ->middleware('auth')
    ->name('transfer_host_confirm');

    // Transfer Host
    Route::post('transfer_host',[UserController::class,'transfer_host'])
    ->middleware('auth')
    ->name('transfer_host');




    // USER_CONFERENCE

    // Update User Conference Payment
    Route::put('update_payment/{user}/{conference}',[ConferenceUserController::class,'update_payment'])
    ->middleware('auth')
    ->name('update_conference_payment');

    // Edit 
    Route::get('edit_conference_user/{user}/{conference}',[ConferenceUserController::class,'edit'])
    ->middleware('auth')
    ->name('edit_conference_user');

    // Update
    Route::put('update_conference_user/{conference_user}',[ConferenceUserController::class,'update'])
    ->middleware('auth')
    ->name('update_conference_user');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
