<?php
namespace Leadrock\Providers;

use Leadrock\Items\Lead;

abstract class Provider
{
    /**
     * @param string $endpoint
     * @param $data
     * @return string
     */
    abstract protected function write($endpoint, $data);

    /**
     * @param string $endpoint
     * @param $id
     * @return array|null
     */
    abstract protected function readById($endpoint, $id);

    /**
     * @param string $endpoint
     * @param int $limit
     * @param int $offset
     * @return array
     */
    abstract protected function readAll($endpoint, $limit = 10, $offset = 0);

    /**
     * Close connection
     */
    abstract public function close();

    /**
     * @param Lead $lead
     * @return array
     */
    public function saveLead(Lead $lead)
    {
        $data = $this->prepareDataToSave(
            $lead->getFullData(),
            $lead->getUserIp(),
            $lead->getUserAgent()
        );
        return json_decode($this->write('lead', $data), true);
    }

    /**
     * Extra data preparation before actual lead save
     *
     * @param $data
     * @param $userIp
     * @param $userAgent
     * @return mixed
     */
    protected function prepareDataToSave($data, $userIp, $userAgent)
    {
        return $data;
    }

    /**
     * Save text to provider
     *
     * @param $text
     */
    public function log($text)
    {
        $this->write('lead', [
            'time' => date('Y-m-d H:i:s'),
            'text' => $text,
        ]);
    }

    /**
     * @param $id
     * @return Lead
     */
    public function openLead($id)
    {
        return (new Lead($id))->restoreFromData($this->readById('lead', $id));
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function readLeads($limit = 10, $offset = 0)
    {
        $leads = [];
        foreach ($this->readAll('lead', $limit, $offset) as $data) {
            $leads[] = (new Lead(null))->restoreFromData($data);
        }
        return $leads;
    }

    /**
     * Restore lead data from one Provider to another
     *
     * @param Provider $provider
     * @param null $timeFrom
     * @param null $timeTo
     * @return array
     */
    public function restoreFromOtherProvider(Provider $provider, $timeFrom=null, $timeTo=null)
    {
        $offset = 0;
        $limit = 100;
        $result = [];
        $requestOffset = isset($_REQUEST['offset']) ? $_REQUEST['offset'] : null;
        $requestLimit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : null;
        do {
            $dataLines = $provider->readAll('lead', $limit, $offset);
            if (!empty($dataLines)) {
                foreach ($dataLines as $data) {
                    if (!empty($timeFrom) && !empty($timeTo) && ((strcmp($data['time'], $timeFrom) < 0) || (strcmp($data['time'], $timeTo) > 0))) {
                        continue;
                    }
                    if (isset($requestOffset) && isset($requestLimit)) {
                        if ($requestOffset-- > 0) {
                            continue;
                        }
                        if ($requestLimit-- <= 0) {
                            break 2;
                        }
                    }
                    if ($this instanceof Leadrock) {
                        $data['is_restored'] = true;
                        $data['time'] = \DateTime::createFromFormat('d.m H:i:s', $data['time'])->getTimestamp();
                    }
                    $result[] = $this->write('lead', $data);
                }
            }

            $offset += $limit;
        } while (!empty($dataLines));
        return $result;
    }

    /**
     * @return string
     */
    public static function getClassName()
    {
        return static::class;
    }

    /**
     * @param $trackingUrl
     * @param $trackId
     * @param $onloadEvent
     * @return null|mixed
     */
    public function getJsInsertionCode($trackingUrl, $trackId, $onloadEvent = '')
    {
        return null;
    }
}