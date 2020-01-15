<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('role')->nullable();
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->string('image')->nullable();
            $table->string('sex_info')->nullable();  
            $table->string('year_info')->nullable();
            $table->string('age_info')->nullable();
            $table->string('race_info')->nullable();
            $table->string('ethnicity_info')->nullable();
            $table->string('education_info')->nullable();
            $table->string('occupation_info')->nullable();
            $table->string('income_info')->nullable();
            $table->string('marital_info')->nullable();
            $table->string('preferred_lang')->nullable();
            $table->string('patient_first')->nullable();
            $table->string('patient_last')->nullable();
            $table->string('patient_date')->nullable();
            $table->string('patient_phy__name')->nullable();
            $table->string('patient_phy__email')->nullable();
            $table->string('patient_phy__phone')->nullable();
            $table->string('care_giver_name')->nullable();
			$table->string('care_giver_email')->nullable();
			$table->string('care_giver_phone')->nullable();
            $table->tinyInteger('clinical_status')->default('0');
            $table->tinyInteger('medical_status')->default('0');
            $table->string('file_name')->nullable();
            $table->string('company_info')->nullable();
            $table->string('job_title_info')->nullable();
            $table->string('principal_specialty')->nullable();
            $table->string('principal_sub_specialty')->nullable();
            $table->string('principal_medical_license')->nullable();
            $table->string('principal_medical_state')->nullable();
            $table->string('principal_research_experience')->nullable();
            $table->longText('principal_therapeutic')->nullable();
            $table->string('principal_sub')->nullable();
            $table->string('principal_cv')->nullable();
            $table->string('principal_site_name')->nullable();
            $table->string('principal_site_address')->nullable();
            $table->string('principal_site_telephone')->nullable();
            $table->string('principal_fax')->nullable();
            $table->string('principal_person_company')->nullable();
            $table->string('principal_email')->nullable();
            $table->string('principal_telephone')->nullable();
            $table->string('research_company')->nullable();
            $table->longText('research_brief')->nullable();
            $table->string('research_per_name')->nullable();
            $table->string('research_per_tele')->nullable();
            $table->string('research_per_email')->nullable();
            $table->string('research_per_address')->nullable();
            $table->string('research_comp_tele')->nullable();
            $table->string('research_comp_fax')->nullable();
            $table->longText('research_therapeutic')->nullable();
            $table->string('sponsor_company')->nullable();
            $table->longText('sponsor_brief')->nullable();
            $table->string('sponsor_per_name')->nullable();
            $table->string('sponsor_per_tele')->nullable();
            $table->string('sponsor_per_email')->nullable();
            $table->string('sponsor_per_address')->nullable();
            $table->string('sponsor_comp_tele')->nullable();
            $table->string('sponsor_comp_fax')->nullable();
            $table->longText('sponsor_therapeutic')->nullable();
            $table->string('physician_specialty')->nullable();
            $table->string('physician_sub_specialty')->nullable();
            $table->string('physician_medical_license')->nullable();
            $table->string('physician_medical_state')->nullable();
            $table->string('physician_research')->nullable();
            $table->string('physician_research_experience')->nullable();
            $table->longText('physician_therapeutic')->nullable();
            $table->string('physician_sub')->nullable();
            $table->string('physician_cv')->nullable();
            $table->string('physician_clinic_info')->nullable();
            $table->string('physician_clinic_address')->nullable();
            $table->string('physician_clinic_tele')->nullable();
            $table->string('physician_clinic_fax')->nullable();
            $table->string('physician_record_storage')->nullable();
            $table->string('clinic_person_contact')->nullable();
            $table->string('clinic_person_email')->nullable();
            $table->string('clinic_person_telephone')->nullable();
            $table->string('clinic_database')->nullable();
            $table->string('med_est_type')->nullable();
            $table->string('other_name')->nullable();
            $table->string('credit_card_info')->nullable();
            $table->string('ach_info')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('routing_number')->nullable();
            $table->string('name_charity')->nullable();
            $table->string('address_charity')->nullable();
            $table->tinyInteger('is_completed')->default('0');
            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
