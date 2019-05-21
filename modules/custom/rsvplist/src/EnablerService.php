<?php
/**
 * @file
 * Contains \Drupal\rsvplist\EnablerService
 */

namespace Drupal\rsvplist;

use Drupal\Core\Database\Database;
use Drupal\node\Entity\Node;

/**
 * Defines a service for managing RSVP list enabled for nodes.
 */
class EnablerService
{

    public function __construct()
    {

    }


    /**
     * Sets a individual node to be RSVP enabled.
     *
     * @param \Drupal\node\Entity\Node $node
     */
    public function setEnabled(Node $node)
    {
        if (! $this->isEnabled($node)) {
            $insert = Database::getConnection()->insert('rsvplist_enabled');
            $insert->fields(['nid'], [$node->id()]);
            $insert->execute();
        }
    }

    /**
     * Checks if an individual node is RSVP enabled.
     *
     * G@param \Drupal\node\Entity\Node $node
     * a
     *
     * @return bool
     * Whether the node is enabled for the RSVP functionality.
     */
    public function isEnabled(Node $node)
    {
        if ($node->isNew()) {
            return false;
        }
        $select = Database::getConnection()->select('rsvplist_enabled', 're');
        $select->fields('re', ['nid']);

        $select->condition('nid', $node->id());

        $results = $select->execute();

        return ! empty($results->fetchCol());
    }

    /**
     * Deletes enabled settings for an individual node.
     *
     * @param \Drupal\node\Entity\Node $node
     */
    public function delEnabled(Node $node)
    {
        $delete = Database::getConnection()->delete('rsvplist_enabled');
        $delete->condition('nid', $node->id());
        $delete->execute();
    }
}
