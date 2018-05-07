<?php

namespace Drupal\commerce_paystack\Form;

use Drupal;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class CommercePaystackConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['commerce_paystack.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'commerce_paystack_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('commerce_paystack.settings');
    $form = parent::buildForm($form, $form_state);
    $form['secret_key'] = [
      '#type' => 'textfield',
      '#required' => true,
      '#title' => $this->t('Secret Key'),
      '#description' => $this->t('Enter your payment API secret key'),
      '#default_value' => $config->get('secret_key'),
    ];
    $form['public_key'] = [
      '#type' => 'textfield',
      '#required' => true,
      '#title' => $this->t('Public Key'),
      '#description' => $this->t('Enter your payment API public key'),
      '#default_value' => $config->get('public_key'),
    ];

    $form['currency_code'] = [
      '#type' => 'texxfield',
      '#required' => true,
      '#title' => $this->t('Currency Code'),
      '#description' => $this->t('Enter your currency code'),
      '#default_value' => $config->get('currency_code'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('commerce_paystack.settings')
      ->set('secret_key', $form_state->getValue('secret_key'))
      ->set('public_key', $form_state->getValue('public_key'))
      ->set('currency_code', $form_state->getValue('currency_code'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
