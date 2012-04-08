<?php

/**
 * PluginaPollPoll form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     Raffaele Bolliger <raffaele.bolliger at gmail.com>
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginaPollPollForm extends BaseaPollPollForm {

    public function setup() {

        parent::setup();

        unset(
                $this['created_at'], $this['updated_at']
        );



        // checking that some polls are available
        if (false === sfConfig::get('app_aPoll_available_polls', false)) {
            throw new sfException('Cannot find any poll item in app_aPoll_available_polls. Please, define some in app.yml');
        }

        $available_polls = sfConfig::get('app_aPoll_available_polls');

        $choices = array();
        $choices_keys = array();
        foreach ($available_polls as $key => $poll) {
            $choices[$key] = isset($poll['name']) ? $poll['name'] : $key;
            $choices_keys[] = $key;
        }

        $this->widgetSchema['type'] = new sfWidgetFormChoice(array('choices' => $choices));

        $this->validatorSchema['type'] = new sfValidatorAnd(
                        array(
                            new sfValidatorChoice(array('choices' => $choices_keys, 'required' => true)),
                            new aPollValidatorPollItem(array('poll_items' => sfConfig::get('app_aPoll_available_polls'))),
                        ),
                        array('halt_on_error' => true)
        );

        $culture = sfContext::getInstance()->getUser()->getCulture(); 
        
        $date_options = array(
                        'image' => '/apostrophePlugin/images/a-icon-datepicker.png',
                        'culture' => $culture,
                        'config' => '{changeMonth: true,changeYear: true}',
                    );
        
        $time_attributes = array('twenty-four-hour' => true, 'minutes-increment' => 30);
        
        $this->setWidget('published_from', new aWidgetFormJQueryDateTime(array(
                    'date' => $date_options,
                        ), array(
                    'time' => $time_attributes,
                )));


        $this->setWidget('published_to', new aWidgetFormJQueryDateTime(array(
                    'date' => $date_options,
                        ), array(
                    'time' => $time_attributes,
                )));




        // setting translation catalogue
        $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('apostrophe');


        // embedding i18n fields
        $culture = sfContext::getInstance()->getUser()->getCulture();
        $languages = sfCultureInfo::getInstance($culture)->getLanguages(sfConfig::get('app_a_i18n_languages'));


        $this->embedI18n(array_keys($languages));
        foreach ($languages as $key => $value) {
            $this->widgetSchema->setLabel($key, ucfirst($value));
        }
    }

}
