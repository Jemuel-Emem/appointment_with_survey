<?php

namespace App\Livewire\Admin;

use App\Models\Resident;
use App\Models\Survey as SurveyModel;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Survey extends Component
{
    public $showModal = false;
    public $survey_id, $title, $description, $form_link;

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function resetFields()
    {
        $this->survey_id = null;
        $this->title = '';
        $this->description = '';
        $this->form_link = '';
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'form_link' => 'required|url',
        ]);

        $survey = SurveyModel::updateOrCreate(
            ['id' => $this->survey_id],
            [
                'title' => $this->title,
                'description' => $this->description,
                'form_link' => $this->form_link,
            ]
        );


        $this->sendSurveyToResidents($survey);

        $this->closeModal();
        session()->flash('message', 'Survey saved successfully!');
    }

    private function sendSurveyToResidents($survey)
    {
        $residents = Resident::whereNotNull('contact_number')->get();

        foreach ($residents as $resident) {
            $this->sendSMS(
                $resident->contact_number,
                "New Survey Available: {$survey->title}. Click here to participate: "
            );
        }
    }

    private function sendSMS($phoneNumber, $message)
    {
        $ch = curl_init();

        $parameters = array(
            'apikey' => '046125f45f4f187e838905df98273c4e',
            'number' => $phoneNumber,
            'message' => $message,
            'sendername' => 'KaisFrozen'
        );

        curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);
        curl_close($ch);




    }

    public function edit($id)
    {
        $survey = SurveyModel::findOrFail($id);
        $this->survey_id = $survey->id;
        $this->title = $survey->title;
        $this->description = $survey->description;
        $this->form_link = $survey->form_link;

        $this->showModal = true;
    }

    public function delete($id)
    {
        SurveyModel::findOrFail($id)->delete();
        session()->flash('message', 'Survey deleted successfully!');
    }

    public function render()
    {
        return view('livewire.admin.survey', [
            'surveys' => SurveyModel::latest()->get(),
        ]);
    }
}
