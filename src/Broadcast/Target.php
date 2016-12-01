<?php

namespace Mediapart\Selligent\Broadcast;

class Target
{
    private $listId;
    private $priorityField;
    private $prioritySorting;
    private $segmentId;
    private $constraint;
    private $scopes;

    public function setListId($listId)
    {
        $this->listId = $listId;

        return $this;
    }

    public function getListId()
    {
        return $this->listId;
    }

    public function setPriorityField($priorityField)
    {
        $this->priorityField = $priorityField;

        return $this;
    }

    public function getPriorityField()
    {
        return $this->priorityField;
    }

    public function setPrioritySorting($prioritySorting)
    {
        $this->prioritySorting = $prioritySorting;

        return $this;
    }

    public function getPrioritySorting()
    {
        return $this->prioritySorting;
    }

    public function setSegmentId($segmentId)
    {
        $this->segmentId = $segmentId;

        return $this;
    }

    public function getSegmentId()
    {
        return $this->segmentId;
    }

    public function setConstraint($constraint)
    {
        $this->constraint = $constraint;

        return $this;
    }

    public function getConstraint()
    {
        return $this->constraint;
    }

    public function setScopes($scopes)
    {
        $this->scopes = $scopes;

        return $this;
    }

    public function getScopes()
    {
        return $this->scopes;
    }
}
