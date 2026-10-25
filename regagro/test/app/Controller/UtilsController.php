<?php
// app/Controller/UtilsController.php
class UtilsController extends AppController {

    public function copyFrom2016()
    {
        $this->loadModel('Registration');
        $this->loadModel('Expertise');
        $this->loadModel('Ban');
        $this->loadModel('Distribution');
        $this->loadModel('Research');
        $this->loadModel('Sample');

        $this->Registration->recursive = -1;
        //$this->Registration->Behaviors->unload('Subsequenced');
        $this->Expertise->recursive = -1;
        $this->Ban->recursive = -1;
        $this->Distribution->recursive = -1;
        $this->Research->recursive = -1;
        $this->Sample->recursive = -1;

        $this->Registration->setDataSource('prod2016');
        $oldRegs = $this->Registration->find('all', ['conditions'=>['date >'=>'2017-01-01 00:00:00']]);
        foreach ($oldRegs as $oldReg)
        {
            $newReg = $oldReg;
            $newReg['Registration']['id'] = NULL;
            //$newReg['Registration']['code'] = -$oldReg['Registration']['code'];
            $this->Registration->setDataSource('default');
            $this->Registration->create();
            $this->Registration->save($newReg);
            $newReg['Registration']['id'] = $this->Registration->id;
            echo 'newReg:'.$newReg['Registration']['id'].'; oldReg:'.$oldReg['Registration']['id'].'<br/>';
            $this->Expertise->setDataSource('prod2016');
            $oldExpertises = $this->Expertise->findAllByRegistrationId($oldReg['Registration']['id']);

            foreach ($oldExpertises as $oldExpertise)
            {
                $newExpertise = $oldExpertise;
                $newExpertise['Expertise']['id'] = NULL;
                $newExpertise['Expertise']['registration_id'] = $newReg['Registration']['id'];
                $this->Expertise->setDataSource('default');
                $this->Expertise->create();
                $this->Expertise->save($newExpertise);
                $newExpertise['Expertise']['id'] = $this->Expertise->id;

                $this->Ban->setDataSource('prod2016');
                $oldBans = $this->Ban->findByExpertiseId($oldExpertise['Expertise']['id']);
                foreach ($oldBans as $oldBan)
                {
                    $newBan = $oldBan;
                    $newBan['Ban']['id'] = NULL;
                    $newBan['Ban']['registration_id'] = $newReg['Registration']['id'];
                    $newBan['Ban']['expertise_id'] = $newExpertise['Expertise']['id'];
                    $this->Ban->setDataSource('default');
                    $this->Ban->create();
                    $this->Ban->save($newBan);
                }

                $this->Distribution->setDataSource('prod2016');
                $oldDistributions = $this->Distribution->findByExpertiseId($oldExpertise['Expertise']['id']);
                foreach ($oldDistributions as $oldDistribution)
                {
                    $newDistribution = $oldDistribution;
                    $newDistribution['Distribution']['id'] = NULL;
                    $newDistribution['Distribution']['registration_id'] = $newReg['Registration']['id'];
                    $newDistribution['Distribution']['expertise_id'] = $newExpertise['Expertise']['id'];
                    $this->Distribution->setDataSource('default');
                    $this->Distribution->create();
                    $this->Distribution->save($newDistribution);
                }

                $this->Research->setDataSource('prod2016');
                $oldResearches = $this->Research->findByExpertiseId($oldExpertise['Expertise']['id']);
                foreach ($oldResearches as $oldResearch)
                {
                    $newResearch = $oldResearch;
                    $newResearch['Research']['id'] = NULL;
                    $newResearch['Research']['registration_id'] = $newReg['Registration']['id'];
                    $newResearch['Research']['expertise_id'] = $newExpertise['Expertise']['id'];
                    $this->Research->setDataSource('default');
                    $this->Research->create();
                    $this->Research->save($newResearch);
                }

                $this->Sample->setDataSource('prod2016');
                $oldSamples = $this->Sample->findByExpertiseId($oldExpertise['Expertise']['id']);
                foreach ($oldSamples as $oldSample)
                {
                    $newSample = $oldSample;
                    $newSample['Sample']['id'] = NULL;
                    $newSample['Sample']['registration_id'] = $newReg['Registration']['id'];
                    $newSample['Sample']['expertise_id'] = $newExpertise['Expertise']['id'];
                    $this->Sample->setDataSource('default');
                    $this->Sample->create();
                    $this->Sample->save($newSample);
                }
            }
        }
    }

}
?>
