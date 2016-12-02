<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent\Broadcast;

/**
 *
 */
class Target
{
    const SORTING_ASC = 'ASC';
    const SORTING_DESC = 'DESC';

    /**
     * @var The ID of the selected list as target for the journey map.
     */
    private $listId;

    /**
     * @var string The field on which the pickup priority for broadcasting is based.
     */
    private $priorityField;

    /**
     * @var string The sorting applied to the pickup priority field.
     */
    private $prioritySorting;

    /**
     * @var integer If selected, the ID of the related segment to be used.
     */
    private $segmentId;

    /**
     * @var string The constraint defined on the targets.
     */
    private $constraint;

    /**
     * @var Array The profile extensions to include in the target.
     */
    private $scopes;

    /**
     * 
     */
    public function __construct()
    {
        $this->scopes = [];
    }

    /**
     * @param integer The ID of the selected list as target for the journey map.
     * @return self
     */
    public function setListId($listId)
    {
        $this->listId = $listId;

        return $this;
    }

    /**
     * @return integer The ID of the selected list as target for the journey map.
     */
    public function getListId()
    {
        return $this->listId;
    }

    /**
     * @param string The field on which the pickup priority for broadcasting is based.
     * @return self 
     */
    public function setPriorityField($priorityField)
    {
        $this->priorityField = $priorityField;

        return $this;
    }

    /**
     * @return string The field on which the pickup priority for broadcasting is based.
     */
    public function getPriorityField()
    {
        return $this->priorityField;
    }

    /**
     * @param string The sorting applied to the pickup priority field. Possible values are ASC and DESC.
     * @throws \InvalidArgumentException
     * @return self
     */
    public function setPrioritySorting($prioritySorting)
    {
        $possibles = [self::SORTING_ASC, self::SORTING_DESC];

        if (in_array($prioritySorting, $possibles)) {
            $this->prioritySorting = $prioritySorting;
        } else {
            throw new \InvalidArgumentException();
        }

        return $this;
    }

    /**
     * @return string The sorting applied to the pickup priority field.
     */
    public function getPrioritySorting()
    {
        return $this->prioritySorting;
    }

    /**
     * @param integer $segmentId If selected, the ID of the related segment to be used.
     * @return self
     */
    public function setSegmentId($segmentId)
    {
        $this->segmentId = $segmentId;

        return $this;
    }

    /**
     * @return integer If selected, the ID of the related segment to be used.
     */
    public function getSegmentId()
    {
        return $this->segmentId;
    }

    /**
     * @param string The constraint defined on the targets.
     * @return self
     */
    public function setConstraint($constraint)
    {
        $this->constraint = $constraint;

        return $this;
    }

    /**
     * @return string The constraint defined on the targets.
     */
    public function getConstraint()
    {
        return $this->constraint;
    }

    /**
     * @param array The profile extensions to include in the target.
     * @return Array 
     */
    public function setScopes($scopes = array())
    {
        $this->scopes = $scopes;

        return $this;
    }

    /**
     * @return string The profile extensions to include in the target. Multiple scopes are separated by a semi colon.
     */
    public function getScopes()
    {
        $scopes = implode(';', $this->scopes);

        return $scopes;
    }
}
