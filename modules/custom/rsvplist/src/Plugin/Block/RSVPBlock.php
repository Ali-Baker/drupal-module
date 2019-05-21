<?php

/**
* @file
* contains \Drupal\rsvplist\Plugin\Block\RSVPBLlock
*/

namespace Drupal\rsvplist\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
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
        return \Drupal::formBuilder()->getForm('Drupal\rsvplist\Form\RSVPForm');
    }

    public function blockAccess(AccountInterface $account)
    {
        /** @var \Drupal\node\Entity\Node $node */
        $node = \Drupal::routeMatch()->getParameter('node');
        $nid = $node->nid->value;
        /** @var \Drupal\rsvplist\EnablerService $enabler */
        $enabler = \Drupal::service('rsvplist.enabler');
        if(is_numeric($nid) && $enabler->isEnabled(($node))) {
            return AccessResult::allowedIfHasPermission($account, 'view rsvplist');
        }
        return AccessResult::forbidden();
    }
}
