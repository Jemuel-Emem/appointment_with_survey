<?php

namespace App\Livewire\Admin;

use App\Models\Survey as SurveyModel;
use Livewire\Component;

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

        SurveyModel::updateOrCreate(
            ['id' => $this->survey_id],
            [
                'title' => $this->title,
                'description' => $this->description,
                'form_link' => $this->form_link,
            ]
        );

        $this->closeModal();
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
    }

    public function render()
    {
        return view('livewire.admin.survey', [
            'surveys' => SurveyModel::latest()->get(),
        ]);
    }
}
