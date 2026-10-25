<?php
namespace Leadrock\Items;

use Leadrock\Providers\Api;
use Leadrock\Providers\Provider;

class Lead
{
    const STATUS_HOLD = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = 2;
    const STATUS_TRASH = 3;

    private $trackId;
    private $status;
    private $params = [];
    /**
     * @var Provider[]
     */
    private $saveProviders = [];

    /**
     * @var string URL referrer to store as lead source
     */
    private $referrer = '';

    private $userIp = '';
    private $userAgent = '';

    /**
     * Lead constructor.
     * @param $trackId
     */
    public function __construct($trackId)
    {
        $this->trackId = $trackId;
        $this->status = self::STATUS_HOLD;
    }

    /**
     * Setting params from input form
     *
     * @param $param
     * @param $value
     * @return $this
     */
    public function setParam($param, $value)
    {
        $this->params[$param] = $value;

        return $this;
    }

    /**
     * @param $ip
     * @param $userAgent
     */
    public function setBrowserParams($ip, $userAgent)
    {
        $this->userIp = $ip;
        $this->userAgent = $userAgent;
    }

    /**
     * @return string
     */
    public function getUserIp()
    {
        return $this->userIp;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Add saving provider to store lead
     *
     * @param Provider $provider
     */
    public function addProvider(Provider $provider)
    {
        $this->saveProviders[] = $provider;
    }

    /**
     * Setting new status
     *
     * @param $status
     * @return $this
     */
    public function changeStatus($status)
    {
        if (in_array($status, [self::STATUS_HOLD, self::STATUS_APPROVED, self::STATUS_REJECTED, self::STATUS_TRASH])) {
            $this->status = $status;
        }
        return $this;
    }

    /**
     * Save lead into assigned providers
     */
    public function save()
    {
        $response = [];
        foreach ($this->saveProviders as $provider) {
            $result = $provider->saveLead($this);
            if (!empty($result)) {
                $response = $result;
            }
        }

        return $response;
    }

    /**
     * Data combine to save in Provider
     *
     * @return array
     */
    public function getFullData()
    {
        return array_merge([
            'track_id' => $this->trackId,
            'status' => $this->status,
            'referrer' => $this->referrer,
        ], $this->params);
    }

    /**
     * Load Lead from data
     *
     * @param $data
     * @return $this
     */
    public function restoreFromData($data)
    {
        $this->trackId = isset($data['track_id']) ? $data['track_id'] : null;
        $this->status = isset($data['status']) ? $data['status'] : self::STATUS_HOLD;
        $this->params = isset($data['params']) ? $data['params'] : [];
        $this->referrer = isset($data['referrer']) ? $data['referrer'] : null;

        return $this;
    }

    /**
     * @return string
     */
    public function getReferrer()
    {
        return $this->referrer;
    }

    /**
     * @param $referrer
     */
    public function setReferrer($referrer)
    {
        $this->referrer = $referrer;
    }
}