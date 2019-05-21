<?php
/**
 * @file
 *  Contains \Drupal\rsvplist\Form\RSVPForm
 */

namespace Drupal\rsvplist\Form;

use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides an RSVP Email form.
 */
class RSVPForm extends FormBase
{

    /**
     * (@inheritdoc)
     */
    public function getFormId()
    {
        return 'rsvplist_email_form';
    }

    /**
     * (@inheritdoc)
     */
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        $value = $form_state->getValue('email');
        if ($value == ! \Drupal::service('email.validator')->isValid($value)) {
            $form_state->setErrorByName('email', t('The email address %mail is not valid.', [
                '%mail' => $value,
            ]));
        }
    }

    /**
     * (@inheritdoc)
     */
    public function submitForm(array &$form, \Drupal\Core\Form\FormStateInterface $form_state)
    {
        drupal_set_message(t('The form is working.'));
    }

    /**
     * (@inheritdoc)
     */
    public function buildForm(array $form, \Drupal\Core\Form\FormStateInterface $form_state)
    {
        $node = \Drupal::routeMatch()->getParameter('node');
        $nid = $node->nid->value;
        $form['email'] = [
            '#title'       => t('Email Address'),
            '#type'        => 'textfield',
            '#size'        => 25,
            '#description' => t("we'll send update to the email address your provide."),
            '#required'    => true,
        ];

        $form['submit'] = [
            '#type'  => 'submit',
            '#value' => t('RSVP'),
        ];

        $form['nid'] = [
            '#type'  => 'hidden',
            '#value' => $nid,
        ];

        return $form;
    }
}
