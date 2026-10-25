<?php
class Amo
{
    const RESPONSIBLE_USER_ID = 1120726;
    const VORONKA_ID = 335863;
    const LEAD_STATUS_ID = 12651238;

    private $url = array(
        'create_lead'    => '/private/api/v2/json/leads/set',
        'create_note'    => '/private/api/v2/json/notes/set',
        'create_contact' => '/private/api/v2/json/contacts/set'
    );

    private $loginData = array(
        'USER_LOGIN' => 'kirill@infoshell.ru',
        'USER_HASH'  => 'adeaefb72861bfb6debeec2555db4f0d' //API key
    );

    const SOURCE_ADDRESS = 'https://inshell.amocrm.ru';


    protected function sendRequest($url, $isPOST, $postData)
    {
        $curl = curl_init();

        $parameters = http_build_query($this->loginData);
        $final_url = $url . '?' . $parameters;

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
        curl_setopt($curl, CURLOPT_URL, $final_url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

        if ($isPOST) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postData));
        }

        $out = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return array(
            'response' => json_decode($out, true),
            'status' => (int)$code
        );
    }

    protected function hasErrors($response)
    {
        $response_data = $response['response'];
        $status_code = $response['status'];

        return (!is_array($response_data) && ($status_code != 200 && $status_code != 204));
    }

    protected function getAddress($urlKey)
    {
        return self::SOURCE_ADDRESS . $this->url[$urlKey];
    }

    public function createLead()
    {
        $id = 0;

        $leads['request']['leads']['add'] = array(
            array(
                'name' => 'Заявка с сайта infoshell.ru',
                'status_id' => self::LEAD_STATUS_ID,
                'pipeline_id' => self::VORONKA_ID,
                'responsible_user_id' => self::RESPONSIBLE_USER_ID
            )
        );

        $address = $this->getAddress('create_lead');
        $result = $this->sendRequest($address, true, $leads);
        $data = $result['response'];

        if (!$this->hasErrors($result)) {
            $newLeads = $data['response']['leads']['add'];
            if (is_array($newLeads) && count($newLeads) > 0) {
                $id = $newLeads[0]['id'];
            }
        }

        return $id;
    }
    
    /**
     * 
     * @param string $name
     * @param int $pipeline_id
     * @return type
    */
    public function createLeadEx($name, $pipeline_id, $status_id = null) 
    {
        $id = 0;

        $leads['request']['leads']['add'] = array(
            array(
                'name' => $name,
                'pipeline_id' => $pipeline_id,
                'status_id' => $status_id ? $status_id : self::LEAD_STATUS_ID,
                'responsible_user_id' => self::RESPONSIBLE_USER_ID
            )
        );

        $address = $this->getAddress('create_lead');
        $result = $this->sendRequest($address, true, $leads);
        $data = $result['response'];

        if (!$this->hasErrors($result)) {
            $newLeads = $data['response']['leads']['add'];
            if (is_array($newLeads) && count($newLeads) > 0) {
                $id = $newLeads[0]['id'];
            }
        }

        return $id;
    }
    
    public function addProductThinking($leadId, $email)
    {
        $id = 0;

        $notes['request']['contacts']['add'] = array(
            array(
                'name' => 'Книга, продуктовое мышление',
                'linked_leads_id' => array($leadId),
                'custom_fields' => array(
                    array(
                        'id' => 1402107, //email
                        'values' => array(
                            array(
                                'value' => $email,
                                'enum'  => 'WORK'
                            )
                        )
                    ),
                )
            )
        );

        $address = $this->getAddress('create_contact');
        $result = $this->sendRequest($address, true, $notes);
        $data = $result['response'];

        if (!$this->hasErrors($result)) {
            $newNotes = $data['response']['contacts']['add'];
            if (is_array($newNotes) && count($newNotes) > 0) {
                $id = $newNotes[0]['id'];
            }
        }

        return $data;
    }
    
    public function addContact($leadId, $name, $mobile, $email)
    {
        $id = 0;

        $contacts['request']['contacts']['add'] = array(
            array(
                'name' => $name,
                'linked_leads_id' => array($leadId),
                'custom_fields' => array(
                    array(
                        'id' => 1402105, //mobile
                        'values' => array(
                            array(
                                'value' => $mobile,
                                'enum'  => 'MOB'
                            )
                        )
                    ),
                    array(
                        'id' => 1402107, //email
                        'values' => array(
                            array(
                                'value' => $email,
                                'enum'  => 'WORK'
                            )
                        )
                    ),
                ),
            ),
        );

        $address = $this->getAddress('create_contact');
        $result = $this->sendRequest($address, true, $contacts);
        $data = $result['response'];

        if (!$this->hasErrors($result)) {
            $newContacts = $data['response']['contacts']['add'];
            if (is_array($newContacts) && count($newContacts) > 0) {
                $id = $newContacts[0]['id'];
            }
        }

        return $id;
    }
    
    public function addNote($leadId, $text)
    {
        $id = 0;

        $notes['request']['notes']['add'] = array(
            array(
                'element_id' => $leadId,
                'element_type' => 2, //сделка
                'note_type' => 4, // обычное примечание
                'text' => $text,
                'responsible_user_id' => self::RESPONSIBLE_USER_ID,
            )
        );

        $address = $this->getAddress('create_note');
        $result = $this->sendRequest($address, true, $notes);
        $data = $result['response'];

        if (!$this->hasErrors($result)) {
            $newNotes = $data['response']['notes']['add'];
            if (is_array($newNotes) && count($newNotes) > 0) {
                $id = $newNotes[0]['id'];
            }
        }

        return $id;
    }

    
    /**
     * 
     * @param type $leadId
     * @param type $platform
     * @param type $stage
     * @param type $field_company
     * @param type $ammount
     * @param type $name
     * @param type $email
     * @param type $comment
     * @param type $post
     * @return type
     */
    public function addCallback(
        $leadId, 
        $client_id,    
        $platform, 
        $stage, 
        $field_company, 
        $ammount, 
        $name, 
        $email, 
        $comment, 
        $post
    ) {
        $id = 0;

        $contacts['request']['contacts']['add'] = array(
            array(
                'name' => $name,
                'linked_leads_id' => array($leadId),
                'custom_fields' => array(
                    array(
                        'id' => 1402111, //YA_CLIENT_ID
                        'values' => array(
                            array(
                                'value' => $client_id,
                                'enum'  => 'YM_CLIENT_ID'
                            )
                        )
                    ),
                    array(
                        'id' => 1402110, //Amount
                        'values' => array(
                            array(
                                'value' => $ammount,
                                'enum'  => 'AMOUNT'
                            )
                        )
                    ),
                    array(
                        'id' => 1402109, //Field company
                        'values' => array(
                            array(
                                'value' => $field_company,
                                'enum'  => 'COMP'
                            )
                        )
                    ),
                    array(
                        'id' => 1402108, //Platform
                        'values' => array(
                            array(
                                'value' => $platform,
                                'enum'  => 'PLAT'
                            )
                        )
                    ),
                    array(
                        'id' => 1402107, //Stage
                        'values' => array(
                            array(
                                'value' => $stage,
                                'enum'  => 'STAGE'
                            )
                        )
                    ),
                    array(
                        'id' => 1402106, //email
                        'values' => array(
                            array(
                                'value' => $email,
                                'enum'  => 'WORK'
                            )
                        )
                    ),
                    array(
                        'id' => 1402105, //comment
                        'values' => array(
                            array(
                                'value' => $post,
                                'enum'  => 'POST'
                            )
                        )
                    ),
                    array(
                        'id' => 1402104, //comment
                        'values' => array(
                            array(
                                'value' => $comment,
                                'enum'  => 'COMM'
                            )
                        )
                    ),
                ),
            ),
        );

        $address = $this->getAddress('create_contact');
        $result = $this->sendRequest($address, true, $contacts);
        $data = $result['response'];

        if (!$this->hasErrors($result)) {
            $newContacts = $data['response']['contacts']['add'];
            if (is_array($newContacts) && count($newContacts) > 0) {
                $id = $newContacts[0]['id'];
            }
        }

        return $id;
    }

}