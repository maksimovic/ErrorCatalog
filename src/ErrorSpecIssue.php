<?php

namespace PandaLeague\ErrorCatalog;

class ErrorSpecIssue
{
    /**
     * @var string $id The ID for the issue.
     */
    private $id;

    /**
     * @var string A reference to identify the issue by. Can be used to retrieve the issue but normally not shown in the catalog
     */
    private $reference;

    /**
     * @var string $issue Use String Formatter syntax to format the issue as a parameterized string. Localize the string.
     */
    private $issue;

    /** @var array an array of parameters to be replaced in the issue message */
    private $parameters;

    /**
     * ErrorSpecIssue constructor.
     * @param string $id
     * @param string $reference
     * @param string $issue
     */
    public function __construct($id, $reference, $issue)
    {
        $this->id = $id;
        $this->reference = $reference;
        $this->issue = $issue;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return $this
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
        
        return $this;
    }

    /**
     * @return array
     */
    private function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return string
     */
    public function getIssue()
    {
        $parameters = $this->getParameters();
        // If parameters have been provided, then ensure that each of the keys are wrapped
        // with curly braces, and prepare it before passing it through strtr()
        if (!empty($parameters)) {
            $parsed = [];

            foreach ($parameters as $key => $value) {
                $parsed['{' . $key . '}'] = $value;
            }

            return strtr($this->issue, $parsed);
        }

        return $this->issue;
    }
}
