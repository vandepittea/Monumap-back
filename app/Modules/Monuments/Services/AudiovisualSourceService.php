<?php

namespace App\Modules\Monuments\Services;

use App\Modules\Core\Services\Service;
use App\Modules\Monuments\Services\AudioVisualSourceLanguageService;
use App\Models\AudiovisualSource;

class AudioVisualSourceService extends Service
{
    protected $_rules = [
        'url' => 'required|url',
        'type' => 'required|string|in:audio,video',
    ];

    protected $_audioVisualSourceLanguageService;

    public function __construct(AudiovisualSource $model, AudioVisualSourceLanguageService $audioVisualSourceLanguageService)
    {
        parent::__construct($model);
        $this->_audioVisualSourceLanguageService = $audioVisualSourceLanguageService;
    }

    public function getOrCreateAudiovisualSource($audiovisualSourceData, $monument)
    {
        $this->checkValidation($audiovisualSourceData);

        $audiovisualSourceResult = array_filter([
            'url' => $audiovisualSourceData['url'],
            'type' => $audiovisualSourceData['type']
        ]);

        $audiovisualSource = $monument->audiovisualSource()->create($audiovisualSourceResult);

        $this->getOrCreateAudiovisualSourceTranslations($audiovisualSource, $audiovisualSourceData['translations']);

        return $audiovisualSource;
    }

    public function deleteUnusedAudiovisualSources($oldAudiovisualSourceId)
    {
        if ($oldAudiovisualSourceId) {
            $this->_model
                ->where('id', $oldAudiovisualSourceId)
                ->whereDoesntHave('monuments')
                ->first();
        }
    }    

    protected function getOrCreateAudiovisualSourceTranslations($audiovisualSource, $translations)
    {
        foreach ($translations as $translationData) {
            $this->_audioVisualSourceLanguageService->getOrCreateAudiovisualSourceLanguage($translationData, $audiovisualSource);
        }
    }
}