<?php

/**
* @file
* contains \Drupal\rsvplist\Plugin\Block\RSVPBLlock
*/

namespace Drupal\rsvplist\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupa\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Provides an 'RSVP' List Block
 * @Block(
 *     id = "rsvp_block",
 *     admin_lael = @Translation("RSVP Block"),
 *     )
 */

class RSVPBlock extends BlockBase{
    /**
     * {@inheritdoc}
     */

    public function build() {
        return ['#markup' => $this->t('My RSVP List Block')];
    }
}
