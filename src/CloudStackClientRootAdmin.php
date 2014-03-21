<?php
require_once dirname(__FILE__) . "/BaseCloudStackClient.php";
require_once dirname(__FILE__) . "/CloudStackClientException.php";

class CloudStackClient extends BaseCloudStackClient {
    
    /**
    * Creates a load balancer rule
    *
    * @param string $algorithm load balancer algorithm (source, roundrobin,
    *        leastconn)
    * @param string $name name of the load balancer rule
    * @param string $privatePort the private port of the private ip address/virtual
    *        machine where the network traffic will be load balanced to
    * @param string $publicPort the public port from where the network traffic will be
    *        load balanced from
    * @param string $account the account associated with the load balancer. Must be
    *        used with the domainId parameter.
    * @param string $cidrList the cidr list to forward traffic from
    * @param string $description the description of the load balancer rule
    * @param string $domainId the domain ID associated with the load balancer
    * @param string $networkId The guest network this rule will be created for.
    *        Required when public Ip address is not associated with any Guest network yet
    *        (VPC case)
    * @param string $openFirewall if true, firewall rule for source/end pubic port is
    *        automatically created; if false - firewall rule has to be created explicitely.
    *        If not specified 1) defaulted to false when LB rule is being created for VPC
    *        guest network 2) in all other cases defaulted to true
    * @param string $protocol The protocol for the LB
    * @param string $publicIpId public ip address id from where the network traffic
    *        will be load balanced from
    * @param string $zoneId zone where the load balancer is going to be created. This
    *        parameter is required when LB service provider is ElasticLoadBalancerVm
    */
    
    public function createLoadBalancerRule($algorithm, $name, $privatePort, $publicPort, $account = "", $cidrList = "", $description = "", $domainId = "", $networkId = "", $openFirewall = "", $protocol = "", $publicIpId = "", $zoneId = "") {

        if (empty($algorithm)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "algorithm"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($privatePort)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "privatePort"), MISSING_ARGUMENT);
        }

        if (empty($publicPort)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "publicPort"), MISSING_ARGUMENT);
        }

        return $this->request("createLoadBalancerRule", array(
            'algorithm' => $algorithm,
            'name' => $name,
            'privateport' => $privatePort,
            'publicport' => $publicPort,
            'account' => $account,
            'cidrlist' => $cidrList,
            'description' => $description,
            'domainid' => $domainId,
            'networkid' => $networkId,
            'openfirewall' => $openFirewall,
            'protocol' => $protocol,
            'publicipid' => $publicIpId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Deletes a load balancer rule.
    *
    * @param string $id the ID of the load balancer rule
    */
    
    public function deleteLoadBalancerRule($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteLoadBalancerRule", array(
            'id' => $id,
        ));
    }
    
    /**
    * Removes a virtual machine or a list of virtual machines from a load balancer rule.
    *
    * @param string $id The ID of the load balancer rule
    * @param string $virtualMachineIds the list of IDs of the virtual machines that
    *        are being removed from the load balancer rule (i.e. virtualMachineIds=1,2,3)
    */
    
    public function removeFromLoadBalancerRule($id, $virtualMachineIds) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($virtualMachineIds)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineIds"), MISSING_ARGUMENT);
        }

        return $this->request("removeFromLoadBalancerRule", array(
            'id' => $id,
            'virtualmachineids' => $virtualMachineIds,
        ));
    }
    
    /**
    * Assigns virtual machine or a list of virtual machines to a load balancer rule.
    *
    * @param string $id the ID of the load balancer rule
    * @param string $virtualMachineIds the list of IDs of the virtual machine that are
    *        being assigned to the load balancer rule(i.e. virtualMachineIds=1,2,3)
    */
    
    public function assignToLoadBalancerRule($id, $virtualMachineIds) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($virtualMachineIds)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineIds"), MISSING_ARGUMENT);
        }

        return $this->request("assignToLoadBalancerRule", array(
            'id' => $id,
            'virtualmachineids' => $virtualMachineIds,
        ));
    }
    
    /**
    * Creates a Load Balancer stickiness policy
    *
    * @param string $lbruleId the ID of the load balancer rule
    * @param string $methodName name of the LB Stickiness policy method, possible
    *        values can be obtained from ListNetworks API
    * @param string $name name of the LB Stickiness policy
    * @param string $description the description of the LB Stickiness policy
    * @param string $param param list. Example:
    *        param[0].name=cookiename&amp;amp;param[0].value=LBCookie
    */
    
    public function createLBStickinessPolicy($lbruleId, $methodName, $name, $description = "", $param = "") {

        if (empty($lbruleId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleId"), MISSING_ARGUMENT);
        }

        if (empty($methodName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "methodName"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        return $this->request("createLBStickinessPolicy", array(
            'lbruleid' => $lbruleId,
            'methodname' => $methodName,
            'name' => $name,
            'description' => $description,
            'param' => $param,
        ));
    }
    
    /**
    * Deletes a LB stickiness policy.
    *
    * @param string $id the ID of the LB stickiness policy
    */
    
    public function deleteLBStickinessPolicy($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteLBStickinessPolicy", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists load balancer rules.
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id the ID of the load balancer rule
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name the name of the load balancer rule
    * @param string $networkId list by network id the rule belongs to
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $publicIpId the public IP address id of the load balancer rule
    * @param string $tags List resources by tags (key/value pairs)
    * @param string $virtualMachineId the ID of the virtual machine of the load
    *        balancer rule
    * @param string $zoneId the availability zone ID
    */
    
    public function listLoadBalancerRules($account = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $name = "", $networkId = "", $page = "", $pageSize = "", $projectId = "", $publicIpId = "", $tags = "", $virtualMachineId = "", $zoneId = "") {

        return $this->request("listLoadBalancerRules", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'name' => $name,
            'networkid' => $networkId,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'publicipid' => $publicIpId,
            'tags' => $tags,
            'virtualmachineid' => $virtualMachineId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Lists LBStickiness policies.
    *
    * @param string $lbruleId the ID of the load balancer rule
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listLBStickinessPolicies($lbruleId, $keyword = "", $page = "", $pageSize = "") {

        if (empty($lbruleId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleId"), MISSING_ARGUMENT);
        }

        return $this->request("listLBStickinessPolicies", array(
            'lbruleid' => $lbruleId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Lists load balancer HealthCheck policies.
    *
    * @param string $lbruleId the ID of the load balancer rule
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listLBHealthCheckPolicies($lbruleId, $keyword = "", $page = "", $pageSize = "") {

        if (empty($lbruleId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleId"), MISSING_ARGUMENT);
        }

        return $this->request("listLBHealthCheckPolicies", array(
            'lbruleid' => $lbruleId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Creates a Load Balancer healthcheck policy
    *
    * @param string $lbruleId the ID of the load balancer rule
    * @param string $description the description of the load balancer HealthCheck
    *        policy
    * @param string $healthyThreshold Number of consecutive health check success
    *        before declaring an instance healthy
    * @param string $intervalTime Amount of time between health checks (1 sec - 20940
    *        sec)
    * @param string $pingPath HTTP Ping Path
    * @param string $responseTimeout Time to wait when receiving a response from the
    *        health check (2sec - 60 sec)
    * @param string $unhealthyThreshold Number of consecutive health check failures
    *        before declaring an instance unhealthy
    */
    
    public function createLBHealthCheckPolicy($lbruleId, $description = "", $healthyThreshold = "", $intervalTime = "", $pingPath = "", $responseTimeout = "", $unhealthyThreshold = "") {

        if (empty($lbruleId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleId"), MISSING_ARGUMENT);
        }

        return $this->request("createLBHealthCheckPolicy", array(
            'lbruleid' => $lbruleId,
            'description' => $description,
            'healthythreshold' => $healthyThreshold,
            'intervaltime' => $intervalTime,
            'pingpath' => $pingPath,
            'responsetimeout' => $responseTimeout,
            'unhealthythreshold' => $unhealthyThreshold,
        ));
    }
    
    /**
    * Deletes a load balancer HealthCheck policy.
    *
    * @param string $id the ID of the load balancer HealthCheck policy
    */
    
    public function deleteLBHealthCheckPolicy($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteLBHealthCheckPolicy", array(
            'id' => $id,
        ));
    }
    
    /**
    * List all virtual machine instances that are assigned to a load balancer rule.
    *
    * @param string $id the ID of the load balancer rule
    * @param string $applied true if listing all virtual machines currently applied to
    *        the load balancer rule; default is true
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listLoadBalancerRuleInstances($id, $applied = "", $keyword = "", $page = "", $pageSize = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("listLoadBalancerRuleInstances", array(
            'id' => $id,
            'applied' => $applied,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Updates load balancer
    *
    * @param string $id the id of the load balancer rule to update
    * @param string $algorithm load balancer algorithm (source, roundrobin,
    *        leastconn)
    * @param string $description the description of the load balancer rule
    * @param string $name the name of the load balancer rule
    */
    
    public function updateLoadBalancerRule($id, $algorithm = "", $description = "", $name = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateLoadBalancerRule", array(
            'id' => $id,
            'algorithm' => $algorithm,
            'description' => $description,
            'name' => $name,
        ));
    }
    
    /**
    * Upload a certificate to cloudstack
    *
    * @param string $certificate SSL certificate
    * @param string $privateKey Private key
    * @param string $certChain Certificate chain of trust
    * @param string $password Password for the private key
    */
    
    public function uploadSslCert($certificate, $privateKey, $certChain = "", $password = "") {

        if (empty($certificate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "certificate"), MISSING_ARGUMENT);
        }

        if (empty($privateKey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "privateKey"), MISSING_ARGUMENT);
        }

        return $this->request("uploadSslCert", array(
            'certificate' => $certificate,
            'privatekey' => $privateKey,
            'certchain' => $certChain,
            'password' => $password,
        ));
    }
    
    /**
    * Delete a certificate to cloudstack
    *
    * @param string $id Id of SSL certificate
    */
    
    public function deleteSslCert($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteSslCert", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists SSL certificates
    *
    * @param string $accountId Account Id
    * @param string $certId Id of SSL certificate
    * @param string $lbruleId Loadbalancer Rule Id
    */
    
    public function listSslCerts($accountId = "", $certId = "", $lbruleId = "") {

        return $this->request("listSslCerts", array(
            'accountid' => $accountId,
            'certid' => $certId,
            'lbruleid' => $lbruleId,
        ));
    }
    
    /**
    * Assigns a certificate to a Load Balancer Rule
    *
    * @param string $certId the ID of the certificate
    * @param string $lbruleId the ID of the load balancer rule
    */
    
    public function assignCertToLoadBalancer($certId, $lbruleId) {

        if (empty($certId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "certId"), MISSING_ARGUMENT);
        }

        if (empty($lbruleId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleId"), MISSING_ARGUMENT);
        }

        return $this->request("assignCertToLoadBalancer", array(
            'certid' => $certId,
            'lbruleid' => $lbruleId,
        ));
    }
    
    /**
    * Removes a certificate from a Load Balancer Rule
    *
    * @param string $lbruleId the ID of the load balancer rule
    */
    
    public function removeCertFromLoadBalancer($lbruleId) {

        if (empty($lbruleId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleId"), MISSING_ARGUMENT);
        }

        return $this->request("removeCertFromLoadBalancer", array(
            'lbruleid' => $lbruleId,
        ));
    }
    
    /**
    * Adds a F5 BigIP load balancer device
    *
    * @param string $networkDeviceType supports only F5BigIpLoadBalancer
    * @param string $password Credentials to reach F5 BigIP load balancer device
    * @param string $physicalNetworkId the Physical Network ID
    * @param string $url URL of the F5 load balancer appliance.
    * @param string $userName Credentials to reach F5 BigIP load balancer device
    */
    
    public function addF5LoadBalancer($networkDeviceType, $password, $physicalNetworkId, $url, $userName) {

        if (empty($networkDeviceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkDeviceType"), MISSING_ARGUMENT);
        }

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        return $this->request("addF5LoadBalancer", array(
            'networkdevicetype' => $networkDeviceType,
            'password' => $password,
            'physicalnetworkid' => $physicalNetworkId,
            'url' => $url,
            'username' => $userName,
        ));
    }
    
    /**
    * configures a F5 load balancer device
    *
    * @param string $lbDeviceId F5 load balancer device ID
    * @param string $lbDeviceCapacity capacity of the device, Capacity will be
    *        interpreted as number of networks device can handle
    */
    
    public function configureF5LoadBalancer($lbDeviceId, $lbDeviceCapacity = "") {

        if (empty($lbDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbDeviceId"), MISSING_ARGUMENT);
        }

        return $this->request("configureF5LoadBalancer", array(
            'lbdeviceid' => $lbDeviceId,
            'lbdevicecapacity' => $lbDeviceCapacity,
        ));
    }
    
    /**
    * delete a F5 load balancer device
    *
    * @param string $lbDeviceId netscaler load balancer device ID
    */
    
    public function deleteF5LoadBalancer($lbDeviceId) {

        if (empty($lbDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbDeviceId"), MISSING_ARGUMENT);
        }

        return $this->request("deleteF5LoadBalancer", array(
            'lbdeviceid' => $lbDeviceId,
        ));
    }
    
    /**
    * lists F5 load balancer devices
    *
    * @param string $keyword List by keyword
    * @param string $lbDeviceId f5 load balancer device ID
    * @param string $page 
    * @param string $pageSize 
    * @param string $physicalNetworkId the Physical Network ID
    */
    
    public function listF5LoadBalancers($keyword = "", $lbDeviceId = "", $page = "", $pageSize = "", $physicalNetworkId = "") {

        return $this->request("listF5LoadBalancers", array(
            'keyword' => $keyword,
            'lbdeviceid' => $lbDeviceId,
            'page' => $page,
            'pagesize' => $pageSize,
            'physicalnetworkid' => $physicalNetworkId,
        ));
    }
    
    /**
    * Adds a netscaler load balancer device
    *
    * @param string $networkDeviceType Netscaler device type supports
    *        NetscalerMPXLoadBalancer, NetscalerVPXLoadBalancer, NetscalerSDXLoadBalancer
    * @param string $password Credentials to reach netscaler load balancer device
    * @param string $physicalNetworkId the Physical Network ID
    * @param string $url URL of the netscaler load balancer appliance.
    * @param string $userName Credentials to reach netscaler load balancer device
    * @param string $gslbProvider true if NetScaler device being added is for
    *        providing GSLB service
    * @param string $gslbProviderPrivateIp public IP of the site
    * @param string $gslbProviderPublicIp public IP of the site
    * @param string $isExclusiveGslbProvider true if NetScaler device being added is
    *        for providing GSLB service exclusively and can not be used for LB
    */
    
    public function addNetscalerLoadBalancer($networkDeviceType, $password, $physicalNetworkId, $url, $userName, $gslbProvider = "", $gslbProviderPrivateIp = "", $gslbProviderPublicIp = "", $isExclusiveGslbProvider = "") {

        if (empty($networkDeviceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkDeviceType"), MISSING_ARGUMENT);
        }

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        return $this->request("addNetscalerLoadBalancer", array(
            'networkdevicetype' => $networkDeviceType,
            'password' => $password,
            'physicalnetworkid' => $physicalNetworkId,
            'url' => $url,
            'username' => $userName,
            'gslbprovider' => $gslbProvider,
            'gslbproviderprivateip' => $gslbProviderPrivateIp,
            'gslbproviderpublicip' => $gslbProviderPublicIp,
            'isexclusivegslbprovider' => $isExclusiveGslbProvider,
        ));
    }
    
    /**
    * delete a netscaler load balancer device
    *
    * @param string $lbDeviceId netscaler load balancer device ID
    */
    
    public function deleteNetscalerLoadBalancer($lbDeviceId) {

        if (empty($lbDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbDeviceId"), MISSING_ARGUMENT);
        }

        return $this->request("deleteNetscalerLoadBalancer", array(
            'lbdeviceid' => $lbDeviceId,
        ));
    }
    
    /**
    * configures a netscaler load balancer device
    *
    * @param string $lbDeviceId Netscaler load balancer device ID
    * @param string $inline true if netscaler load balancer is intended to be used in
    *        in-line with firewall, false if netscaler load balancer will side-by-side with
    *        firewall
    * @param string $lbDeviceCapacity capacity of the device, Capacity will be
    *        interpreted as number of networks device can handle
    * @param string $lbDeviceDedicated true if this netscaler device to dedicated for
    *        a account, false if the netscaler device will be shared by multiple accounts
    * @param string $podIds Used when NetScaler device is provider of EIP service.
    *        This parameter represents the list of pod&#039;s, for which there exists a
    *        policy based route on datacenter L3 router to route pod&#039;s subnet IP to a
    *        NetScaler device.
    */
    
    public function configureNetscalerLoadBalancer($lbDeviceId, $inline = "", $lbDeviceCapacity = "", $lbDeviceDedicated = "", $podIds = "") {

        if (empty($lbDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbDeviceId"), MISSING_ARGUMENT);
        }

        return $this->request("configureNetscalerLoadBalancer", array(
            'lbdeviceid' => $lbDeviceId,
            'inline' => $inline,
            'lbdevicecapacity' => $lbDeviceCapacity,
            'lbdevicededicated' => $lbDeviceDedicated,
            'podids' => $podIds,
        ));
    }
    
    /**
    * lists netscaler load balancer devices
    *
    * @param string $keyword List by keyword
    * @param string $lbDeviceId netscaler load balancer device ID
    * @param string $page 
    * @param string $pageSize 
    * @param string $physicalNetworkId the Physical Network ID
    */
    
    public function listNetscalerLoadBalancers($keyword = "", $lbDeviceId = "", $page = "", $pageSize = "", $physicalNetworkId = "") {

        return $this->request("listNetscalerLoadBalancers", array(
            'keyword' => $keyword,
            'lbdeviceid' => $lbDeviceId,
            'page' => $page,
            'pagesize' => $pageSize,
            'physicalnetworkid' => $physicalNetworkId,
        ));
    }
    
    /**
    * Creates a global load balancer rule
    *
    * @param string $gslbDomainName domain name for the GSLB service.
    * @param string $gslbServiceType GSLB service type (tcp, udp, http)
    * @param string $name name of the load balancer rule
    * @param string $regionId region where the global load balancer is going to be
    *        created.
    * @param string $account the account associated with the global load balancer.
    *        Must be used with the domainId parameter.
    * @param string $description the description of the load balancer rule
    * @param string $domainId the domain ID associated with the load balancer
    * @param string $gslblbMethod load balancer algorithm (roundrobin, leastconn,
    *        proximity) that method is used to distribute traffic across the zones
    *        participating in global server load balancing, if not specified defaults to
    *        &#039;round robin&#039;
    * @param string $gslbStickySessionMethodName session sticky method (sourceip) if
    *        not specified defaults to sourceip
    */
    
    public function createGlobalLoadBalancerRule($gslbDomainName, $gslbServiceType, $name, $regionId, $account = "", $description = "", $domainId = "", $gslblbMethod = "", $gslbStickySessionMethodName = "") {

        if (empty($gslbDomainName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gslbDomainName"), MISSING_ARGUMENT);
        }

        if (empty($gslbServiceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gslbServiceType"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($regionId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "regionId"), MISSING_ARGUMENT);
        }

        return $this->request("createGlobalLoadBalancerRule", array(
            'gslbdomainname' => $gslbDomainName,
            'gslbservicetype' => $gslbServiceType,
            'name' => $name,
            'regionid' => $regionId,
            'account' => $account,
            'description' => $description,
            'domainid' => $domainId,
            'gslblbmethod' => $gslblbMethod,
            'gslbstickysessionmethodname' => $gslbStickySessionMethodName,
        ));
    }
    
    /**
    * Deletes a global load balancer rule.
    *
    * @param string $id the ID of the global load balancer rule
    */
    
    public function deleteGlobalLoadBalancerRule($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteGlobalLoadBalancerRule", array(
            'id' => $id,
        ));
    }
    
    /**
    * update global load balancer rules.
    *
    * @param string $id the ID of the global load balancer rule
    * @param string $description the description of the load balancer rule
    * @param string $gslblbMethod load balancer algorithm (roundrobin, leastconn,
    *        proximity) that is used to distributed traffic across the zones participating in
    *        global server load balancing, if not specified defaults to &#039;round
    *        robin&#039;
    * @param string $gslbStickySessionMethodName session sticky method (sourceip) if
    *        not specified defaults to sourceip
    */
    
    public function updateGlobalLoadBalancerRule($id, $description = "", $gslblbMethod = "", $gslbStickySessionMethodName = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateGlobalLoadBalancerRule", array(
            'id' => $id,
            'description' => $description,
            'gslblbmethod' => $gslblbMethod,
            'gslbstickysessionmethodname' => $gslbStickySessionMethodName,
        ));
    }
    
    /**
    * Lists load balancer rules.
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id the ID of the global load balancer rule
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $regionId region ID
    * @param string $tags List resources by tags (key/value pairs)
    */
    
    public function listGlobalLoadBalancerRules($account = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $projectId = "", $regionId = "", $tags = "") {

        return $this->request("listGlobalLoadBalancerRules", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'regionid' => $regionId,
            'tags' => $tags,
        ));
    }
    
    /**
    * Assign load balancer rule or list of load balancer rules to a global load balancer rules.
    *
    * @param string $id the ID of the global load balancer rule
    * @param string $loadBalancerRuleList the list load balancer rules that will be
    *        assigned to gloabal load balacner rule
    * @param string $gslbLbRuleWeightsMap Map of LB rule id&#039;s and corresponding
    *        weights (between 1-100) in the GSLB rule, if not specified weight of a LB rule
    *        is defaulted to 1. Specified as
    *        &#039;gslblbruleweightsmap[0].loadbalancerid=UUID&amp;amp;gslblbruleweightsmap[0
    *        ].weight=10&#039;
    */
    
    public function assignToGlobalLoadBalancerRule($id, $loadBalancerRuleList, $gslbLbRuleWeightsMap = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($loadBalancerRuleList)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "loadBalancerRuleList"), MISSING_ARGUMENT);
        }

        return $this->request("assignToGlobalLoadBalancerRule", array(
            'id' => $id,
            'loadbalancerrulelist' => $loadBalancerRuleList,
            'gslblbruleweightsmap' => $gslbLbRuleWeightsMap,
        ));
    }
    
    /**
    * Removes a load balancer rule association with global load balancer rule
    *
    * @param string $id The ID of the load balancer rule
    * @param string $loadBalancerRuleList the list load balancer rules that will be
    *        assigned to gloabal load balacner rule
    */
    
    public function removeFromGlobalLoadBalancerRule($id, $loadBalancerRuleList) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($loadBalancerRuleList)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "loadBalancerRuleList"), MISSING_ARGUMENT);
        }

        return $this->request("removeFromGlobalLoadBalancerRule", array(
            'id' => $id,
            'loadbalancerrulelist' => $loadBalancerRuleList,
        ));
    }
    
    /**
    * Creates a Load Balancer
    *
    * @param string $algorithm load balancer algorithm (source, roundrobin,
    *        leastconn)
    * @param string $instancePort the TCP port of the virtual machine where the
    *        network traffic will be load balanced to
    * @param string $name name of the Load Balancer
    * @param string $networkId The guest network the Load Balancer will be created
    *        for
    * @param string $scheme the load balancer scheme. Supported value in this release
    *        is Internal
    * @param string $sourceIpAddressNetworkId the network id of the source ip address
    * @param string $sourcePort the source port the network traffic will be load
    *        balanced from
    * @param string $description the description of the Load Balancer
    * @param string $sourceIpAddress the source ip address the network traffic will be
    *        load balanced from
    */
    
    public function createLoadBalancer($algorithm, $instancePort, $name, $networkId, $scheme, $sourceIpAddressNetworkId, $sourcePort, $description = "", $sourceIpAddress = "") {

        if (empty($algorithm)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "algorithm"), MISSING_ARGUMENT);
        }

        if (empty($instancePort)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "instancePort"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($networkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkId"), MISSING_ARGUMENT);
        }

        if (empty($scheme)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "scheme"), MISSING_ARGUMENT);
        }

        if (empty($sourceIpAddressNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "sourceIpAddressNetworkId"), MISSING_ARGUMENT);
        }

        if (empty($sourcePort)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "sourcePort"), MISSING_ARGUMENT);
        }

        return $this->request("createLoadBalancer", array(
            'algorithm' => $algorithm,
            'instanceport' => $instancePort,
            'name' => $name,
            'networkid' => $networkId,
            'scheme' => $scheme,
            'sourceipaddressnetworkid' => $sourceIpAddressNetworkId,
            'sourceport' => $sourcePort,
            'description' => $description,
            'sourceipaddress' => $sourceIpAddress,
        ));
    }
    
    /**
    * Lists Load Balancers
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id the ID of the Load Balancer
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name the name of the Load Balancer
    * @param string $networkId the network id of the Load Balancer
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $scheme the scheme of the Load Balancer. Supported value is
    *        Internal in the current release
    * @param string $sourceIpAddress the source ip address of the Load Balancer
    * @param string $sourceIpAddressNetworkId the network id of the source ip address
    * @param string $tags List resources by tags (key/value pairs)
    */
    
    public function listLoadBalancers($account = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $name = "", $networkId = "", $page = "", $pageSize = "", $projectId = "", $scheme = "", $sourceIpAddress = "", $sourceIpAddressNetworkId = "", $tags = "") {

        return $this->request("listLoadBalancers", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'name' => $name,
            'networkid' => $networkId,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'scheme' => $scheme,
            'sourceipaddress' => $sourceIpAddress,
            'sourceipaddressnetworkid' => $sourceIpAddressNetworkId,
            'tags' => $tags,
        ));
    }
    
    /**
    * Deletes a load balancer
    *
    * @param string $id the ID of the Load Balancer
    */
    
    public function deleteLoadBalancer($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteLoadBalancer", array(
            'id' => $id,
        ));
    }
    
    /**
    * Dedicates a Public IP range to an account
    *
    * @param string $id the id of the VLAN IP range
    * @param string $account account who will own the VLAN
    * @param string $domainId domain ID of the account owning a VLAN
    * @param string $projectId project who will own the VLAN
    */
    
    public function dedicatePublicIpRange($id, $account, $domainId, $projectId = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }

        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }

        return $this->request("dedicatePublicIpRange", array(
            'id' => $id,
            'account' => $account,
            'domainid' => $domainId,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * Releases a Public IP range back to the system pool
    *
    * @param string $id the id of the Public IP range
    */
    
    public function releasePublicIpRange($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("releasePublicIpRange", array(
            'id' => $id,
        ));
    }
    
    /**
    * Creates a network
    *
    * @param string $displayText the display text of the network
    * @param string $name the name of the network
    * @param string $networkOfferingId the network offering id
    * @param string $zoneId the Zone ID for the network
    * @param string $account account who will own the network
    * @param string $aclId Network ACL Id associated for the network
    * @param string $aclType Access control type; supported values are account and
    *        domain. In 3.0 all shared networks should have aclType=Domain, and all Isolated
    *        networks - Account. Account means that only the account owner can use the
    *        network, domain - all accouns in the domain can use the network
    * @param string $displayNetwork an optional field, whether to the display the
    *        network to the end user or not.
    * @param string $domainId domain ID of the account owning a network
    * @param string $endIp the ending IP address in the network IP range. If not
    *        specified, will be defaulted to startIP
    * @param string $endIpv6 the ending IPv6 address in the IPv6 network range
    * @param string $gateway the gateway of the network. Required for Shared networks
    *        and Isolated networks when it belongs to VPC
    * @param string $ip6Cidr the CIDR of IPv6 network, must be at least /64
    * @param string $ip6Gateway the gateway of the IPv6 network. Required for Shared
    *        networks and Isolated networks when it belongs to VPC
    * @param string $isolatedPvlan the isolated private vlan for this network
    * @param string $netmask the netmask of the network. Required for Shared networks
    *        and Isolated networks when it belongs to VPC
    * @param string $networkDomain network domain
    * @param string $physicalNetworkId the Physical Network ID the network belongs to
    * @param string $projectId an optional project for the ssh key
    * @param string $startIp the beginning IP address in the network IP range
    * @param string $startIpv6 the beginning IPv6 address in the IPv6 network range
    * @param string $subDomainAccess Defines whether to allow subdomains to use
    *        networks dedicated to their parent domain(s). Should be used with
    *        aclType=Domain, defaulted to allow.subdomain.network.access global config if not
    *        specified
    * @param string $vlan the ID or VID of the network
    * @param string $vpcId the VPC network belongs to
    */
    
    public function createNetwork($displayText, $name, $networkOfferingId, $zoneId, $account = "", $aclId = "", $aclType = "", $displayNetwork = "", $domainId = "", $endIp = "", $endIpv6 = "", $gateway = "", $ip6Cidr = "", $ip6Gateway = "", $isolatedPvlan = "", $netmask = "", $networkDomain = "", $physicalNetworkId = "", $projectId = "", $startIp = "", $startIpv6 = "", $subDomainAccess = "", $vlan = "", $vpcId = "") {

        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($networkOfferingId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkOfferingId"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("createNetwork", array(
            'displaytext' => $displayText,
            'name' => $name,
            'networkofferingid' => $networkOfferingId,
            'zoneid' => $zoneId,
            'account' => $account,
            'aclid' => $aclId,
            'acltype' => $aclType,
            'displaynetwork' => $displayNetwork,
            'domainid' => $domainId,
            'endip' => $endIp,
            'endipv6' => $endIpv6,
            'gateway' => $gateway,
            'ip6cidr' => $ip6Cidr,
            'ip6gateway' => $ip6Gateway,
            'isolatedpvlan' => $isolatedPvlan,
            'netmask' => $netmask,
            'networkdomain' => $networkDomain,
            'physicalnetworkid' => $physicalNetworkId,
            'projectid' => $projectId,
            'startip' => $startIp,
            'startipv6' => $startIpv6,
            'subdomainaccess' => $subDomainAccess,
            'vlan' => $vlan,
            'vpcid' => $vpcId,
        ));
    }
    
    /**
    * Deletes a network
    *
    * @param string $id the ID of the network
    * @param string $forced Force delete a network. Network will be marked as
    *        &#039;Destroy&#039; even when commands to shutdown and cleanup to the backend
    *        fails.
    */
    
    public function deleteNetwork($id, $forced = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteNetwork", array(
            'id' => $id,
            'forced' => $forced,
        ));
    }
    
    /**
    * Lists all available networks.
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $aclType list networks by ACL (access control list) type.
    *        Supported values are Account and Domain
    * @param string $canUseForDeploy list networks available for vm deployment
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $forVpc the network belongs to vpc
    * @param string $id list networks by id
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $isSystem true if network is system, false otherwise
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $physicalNetworkId list networks by physical network id
    * @param string $projectId list objects by project
    * @param string $restartRequired list networks by restartRequired
    * @param string $specifyIpRanges true if need to list only networks which support
    *        specifying ip ranges
    * @param string $supportedServices list networks supporting certain services
    * @param string $tags List resources by tags (key/value pairs)
    * @param string $trafficType type of the traffic
    * @param string $type the type of the network. Supported values are: Isolated and
    *        Shared
    * @param string $vpcId List networks by VPC
    * @param string $zoneId the Zone ID of the network
    */
    
    public function listNetworks($account = "", $aclType = "", $canUseForDeploy = "", $domainId = "", $forVpc = "", $id = "", $isRecursive = "", $isSystem = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $physicalNetworkId = "", $projectId = "", $restartRequired = "", $specifyIpRanges = "", $supportedServices = "", $tags = "", $trafficType = "", $type = "", $vpcId = "", $zoneId = "") {

        return $this->request("listNetworks", array(
            'account' => $account,
            'acltype' => $aclType,
            'canusefordeploy' => $canUseForDeploy,
            'domainid' => $domainId,
            'forvpc' => $forVpc,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'issystem' => $isSystem,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'physicalnetworkid' => $physicalNetworkId,
            'projectid' => $projectId,
            'restartrequired' => $restartRequired,
            'specifyipranges' => $specifyIpRanges,
            'supportedservices' => $supportedServices,
            'tags' => $tags,
            'traffictype' => $trafficType,
            'type' => $type,
            'vpcid' => $vpcId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Restarts the network; includes 1) restarting network elements - virtual routers, dhcp servers 2) reapplying all public ips 3) reapplying loadBalancing/portForwarding rules
    *
    * @param string $id The id of the network to restart.
    * @param string $cleanup If cleanup old network elements
    */
    
    public function restartNetwork($id, $cleanup = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("restartNetwork", array(
            'id' => $id,
            'cleanup' => $cleanup,
        ));
    }
    
    /**
    * Updates a network
    *
    * @param string $id the ID of the network
    * @param string $changeCidr Force update even if cidr type is different
    * @param string $displayNetwork an optional field, whether to the display the
    *        network to the end user or not.
    * @param string $displayText the new display text for the network
    * @param string $guestVmCidr CIDR for Guest VMs,Cloudstack allocates IPs to Guest
    *        VMs only from this CIDR
    * @param string $name the new name for the network
    * @param string $networkDomain network domain
    * @param string $networkOfferingId network offering ID
    */
    
    public function updateNetwork($id, $changeCidr = "", $displayNetwork = "", $displayText = "", $guestVmCidr = "", $name = "", $networkDomain = "", $networkOfferingId = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateNetwork", array(
            'id' => $id,
            'changecidr' => $changeCidr,
            'displaynetwork' => $displayNetwork,
            'displaytext' => $displayText,
            'guestvmcidr' => $guestVmCidr,
            'name' => $name,
            'networkdomain' => $networkDomain,
            'networkofferingid' => $networkOfferingId,
        ));
    }
    
    /**
    * Creates a physical network
    *
    * @param string $name the name of the physical network
    * @param string $zoneId the Zone ID for the physical network
    * @param string $broadcastDomainRange the broadcast domain range for the physical
    *        network[Pod or Zone]. In Acton release it can be Zone only in Advance zone, and
    *        Pod in Basic
    * @param string $domainId domain ID of the account owning a physical network
    * @param string $isolationMethods the isolation method for the physical
    *        network[VLAN/L3/GRE]
    * @param string $networkSpeed the speed for the physical network[1G/10G]
    * @param string $tags Tag the physical network
    * @param string $vlan the VLAN for the physical network
    */
    
    public function createPhysicalNetwork($name, $zoneId, $broadcastDomainRange = "", $domainId = "", $isolationMethods = "", $networkSpeed = "", $tags = "", $vlan = "") {

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("createPhysicalNetwork", array(
            'name' => $name,
            'zoneid' => $zoneId,
            'broadcastdomainrange' => $broadcastDomainRange,
            'domainid' => $domainId,
            'isolationmethods' => $isolationMethods,
            'networkspeed' => $networkSpeed,
            'tags' => $tags,
            'vlan' => $vlan,
        ));
    }
    
    /**
    * Deletes a Physical Network.
    *
    * @param string $id the ID of the Physical network
    */
    
    public function deletePhysicalNetwork($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deletePhysicalNetwork", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists physical networks
    *
    * @param string $id list physical network by id
    * @param string $keyword List by keyword
    * @param string $name search by name
    * @param string $page 
    * @param string $pageSize 
    * @param string $zoneId the Zone ID for the physical network
    */
    
    public function listPhysicalNetworks($id = "", $keyword = "", $name = "", $page = "", $pageSize = "", $zoneId = "") {

        return $this->request("listPhysicalNetworks", array(
            'id' => $id,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Updates a physical network
    *
    * @param string $id physical network id
    * @param string $networkSpeed the speed for the physical network[1G/10G]
    * @param string $state Enabled/Disabled
    * @param string $tags Tag the physical network
    * @param string $vlan the VLAN for the physical network
    */
    
    public function updatePhysicalNetwork($id, $networkSpeed = "", $state = "", $tags = "", $vlan = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updatePhysicalNetwork", array(
            'id' => $id,
            'networkspeed' => $networkSpeed,
            'state' => $state,
            'tags' => $tags,
            'vlan' => $vlan,
        ));
    }
    
    /**
    * Lists all network services provided by CloudStack or for the given Provider.
    *
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $provider network service provider name
    * @param string $service network service name to list providers and capabilities
    *        of
    */
    
    public function listSupportedNetworkServices($keyword = "", $page = "", $pageSize = "", $provider = "", $service = "") {

        return $this->request("listSupportedNetworkServices", array(
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'provider' => $provider,
            'service' => $service,
        ));
    }
    
    /**
    * Adds a network serviceProvider to a physical network
    *
    * @param string $name the name for the physical network service provider
    * @param string $physicalNetworkId the Physical Network ID to add the provider to
    * @param string $destinationPhysicalNetworkId the destination Physical Network ID
    *        to bridge to
    * @param string $serviceList the list of services to be enabled for this physical
    *        network service provider
    */
    
    public function addNetworkServiceProvider($name, $physicalNetworkId, $destinationPhysicalNetworkId = "", $serviceList = "") {

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }

        return $this->request("addNetworkServiceProvider", array(
            'name' => $name,
            'physicalnetworkid' => $physicalNetworkId,
            'destinationphysicalnetworkid' => $destinationPhysicalNetworkId,
            'servicelist' => $serviceList,
        ));
    }
    
    /**
    * Deletes a Network Service Provider.
    *
    * @param string $id the ID of the network service provider
    */
    
    public function deleteNetworkServiceProvider($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteNetworkServiceProvider", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists network serviceproviders for a given physical network.
    *
    * @param string $keyword List by keyword
    * @param string $name list providers by name
    * @param string $page 
    * @param string $pageSize 
    * @param string $physicalNetworkId the Physical Network ID
    * @param string $state list providers by state
    */
    
    public function listNetworkServiceProviders($keyword = "", $name = "", $page = "", $pageSize = "", $physicalNetworkId = "", $state = "") {

        return $this->request("listNetworkServiceProviders", array(
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'physicalnetworkid' => $physicalNetworkId,
            'state' => $state,
        ));
    }
    
    /**
    * Updates a network serviceProvider of a physical network
    *
    * @param string $id network service provider id
    * @param string $serviceList the list of services to be enabled for this physical
    *        network service provider
    * @param string $state Enabled/Disabled/Shutdown the physical network service
    *        provider
    */
    
    public function updateNetworkServiceProvider($id, $serviceList = "", $state = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateNetworkServiceProvider", array(
            'id' => $id,
            'servicelist' => $serviceList,
            'state' => $state,
        ));
    }
    
    /**
    * Creates a Storage network IP range.
    *
    * @param string $gateway the gateway for storage network
    * @param string $netmask the netmask for storage network
    * @param string $podId UUID of pod where the ip range belongs to
    * @param string $startIp the beginning IP address
    * @param string $endIp the ending IP address
    * @param string $vlan Optional. The vlan the ip range sits on, default to Null
    *        when it is not specificed which means you network is not on any Vlan. This is
    *        mainly for Vmware as other hypervisors can directly reterive bridge from
    *        pyhsical network traffic type table
    */
    
    public function createStorageNetworkIpRange($gateway, $netmask, $podId, $startIp, $endIp = "", $vlan = "") {

        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gateway"), MISSING_ARGUMENT);
        }

        if (empty($netmask)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "netmask"), MISSING_ARGUMENT);
        }

        if (empty($podId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "podId"), MISSING_ARGUMENT);
        }

        if (empty($startIp)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "startIp"), MISSING_ARGUMENT);
        }

        return $this->request("createStorageNetworkIpRange", array(
            'gateway' => $gateway,
            'netmask' => $netmask,
            'podid' => $podId,
            'startip' => $startIp,
            'endip' => $endIp,
            'vlan' => $vlan,
        ));
    }
    
    /**
    * Deletes a storage network IP Range.
    *
    * @param string $id the uuid of the storage network ip range
    */
    
    public function deleteStorageNetworkIpRange($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteStorageNetworkIpRange", array(
            'id' => $id,
        ));
    }
    
    /**
    * List a storage network IP range.
    *
    * @param string $id optional parameter. Storaget network IP range uuid, if
    *        specicied, using it to search the range.
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $podId optional parameter. Pod uuid, if specicied and range uuid
    *        is absent, using it to search the range.
    * @param string $zoneId optional parameter. Zone uuid, if specicied and both pod
    *        uuid and range uuid are absent, using it to search the range.
    */
    
    public function listStorageNetworkIpRange($id = "", $keyword = "", $page = "", $pageSize = "", $podId = "", $zoneId = "") {

        return $this->request("listStorageNetworkIpRange", array(
            'id' => $id,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'podid' => $podId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Update a Storage network IP range, only allowed when no IPs in this range have been allocated.
    *
    * @param string $id UUID of storage network ip range
    * @param string $endIp the ending IP address
    * @param string $netmask the netmask for storage network
    * @param string $startIp the beginning IP address
    * @param string $vlan Optional. the vlan the ip range sits on
    */
    
    public function updateStorageNetworkIpRange($id, $endIp = "", $netmask = "", $startIp = "", $vlan = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateStorageNetworkIpRange", array(
            'id' => $id,
            'endip' => $endIp,
            'netmask' => $netmask,
            'startip' => $startIp,
            'vlan' => $vlan,
        ));
    }
    
    /**
    * lists network that are using a F5 load balancer device
    *
    * @param string $lbDeviceId f5 load balancer device ID
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listF5LoadBalancerNetworks($lbDeviceId, $keyword = "", $page = "", $pageSize = "") {

        if (empty($lbDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbDeviceId"), MISSING_ARGUMENT);
        }

        return $this->request("listF5LoadBalancerNetworks", array(
            'lbdeviceid' => $lbDeviceId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * lists network that are using SRX firewall device
    *
    * @param string $lbDeviceId netscaler load balancer device ID
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listSrxFirewallNetworks($lbDeviceId, $keyword = "", $page = "", $pageSize = "") {

        if (empty($lbDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbDeviceId"), MISSING_ARGUMENT);
        }

        return $this->request("listSrxFirewallNetworks", array(
            'lbdeviceid' => $lbDeviceId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * lists network that are using Palo Alto firewall device
    *
    * @param string $lbDeviceId palo alto balancer device ID
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listPaloAltoFirewallNetworks($lbDeviceId, $keyword = "", $page = "", $pageSize = "") {

        if (empty($lbDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbDeviceId"), MISSING_ARGUMENT);
        }

        return $this->request("listPaloAltoFirewallNetworks", array(
            'lbdeviceid' => $lbDeviceId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * lists network that are using a netscaler load balancer device
    *
    * @param string $lbDeviceId netscaler load balancer device ID
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listNetscalerLoadBalancerNetworks($lbDeviceId, $keyword = "", $page = "", $pageSize = "") {

        if (empty($lbDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbDeviceId"), MISSING_ARGUMENT);
        }

        return $this->request("listNetscalerLoadBalancerNetworks", array(
            'lbdeviceid' => $lbDeviceId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * lists network that are using a nicira nvp device
    *
    * @param string $nvpDeviceId nicira nvp device ID
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listNiciraNvpDeviceNetworks($nvpDeviceId, $keyword = "", $page = "", $pageSize = "") {

        if (empty($nvpDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nvpDeviceId"), MISSING_ARGUMENT);
        }

        return $this->request("listNiciraNvpDeviceNetworks", array(
            'nvpdeviceid' => $nvpDeviceId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Lists supported methods of network isolation
    *
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listNetworkIsolationMethods($keyword = "", $page = "", $pageSize = "") {

        return $this->request("listNetworkIsolationMethods", array(
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Creates and automatically starts a virtual machine based on a service offering, disk offering, and template.
    *
    * @param string $serviceOfferingId the ID of the service offering for the virtual
    *        machine
    * @param string $templateId the ID of the template for the virtual machine
    * @param string $zoneId availability zone for the virtual machine
    * @param string $account an optional account for the virtual machine. Must be used
    *        with domainId.
    * @param string $affinityGroupIds comma separated list of affinity groups id that
    *        are going to be applied to the virtual machine. Mutually exclusive with
    *        affinitygroupnames parameter
    * @param string $affinityGroupNames comma separated list of affinity groups names
    *        that are going to be applied to the virtual machine.Mutually exclusive with
    *        affinitygroupids parameter
    * @param string $details used to specify the custom parameters.
    * @param string $diskOfferingId the ID of the disk offering for the virtual
    *        machine. If the template is of ISO format, the diskOfferingId is for the root
    *        disk volume. Otherwise this parameter is used to indicate the offering for the
    *        data disk volume. If the templateId parameter passed is from a Template object,
    *        the diskOfferingId refers to a DATA Disk Volume created. If the templateId
    *        parameter passed is from an ISO object, the diskOfferingId refers to a ROOT Disk
    *        Volume created.
    * @param string $displayName an optional user generated name for the virtual
    *        machine
    * @param string $displayVm an optional field, whether to the display the vm to the
    *        end user or not.
    * @param string $domainId an optional domainId for the virtual machine. If the
    *        account parameter is used, domainId must also be used.
    * @param string $group an optional group for the virtual machine
    * @param string $hostId destination Host ID to deploy the VM to - parameter
    *        available for root admin only
    * @param string $hypervisor the hypervisor on which to deploy the virtual machine
    * @param string $ip6Address the ipv6 address for default vm&#039;s network
    * @param string $ipAddress the ip address for default vm&#039;s network
    * @param string $ipToNetWorkList ip to network mapping. Can&#039;t be specified
    *        with networkIds parameter. Example:
    *        iptonetworklist[0].ip=10.10.10.11&amp;amp;iptonetworklist[0].ipv6=fc00:1234:5678
    *        ::abcd&amp;amp;iptonetworklist[0].networkid=uuid - requests to use ip
    *        10.10.10.11 in network id=uuid
    * @param string $keyboard an optional keyboard device type for the virtual
    *        machine. valid value can be one of
    *        de,de-ch,es,fi,fr,fr-be,fr-ch,is,it,jp,nl-be,no,pt,uk,us
    * @param string $keyPair name of the ssh key pair used to login to the virtual
    *        machine
    * @param string $name host name for the virtual machine
    * @param string $networkIds list of network ids used by virtual machine.
    *        Can&#039;t be specified with ipToNetworkList parameter
    * @param string $projectId Deploy vm for the project
    * @param string $securityGroupIds comma separated list of security groups id that
    *        going to be applied to the virtual machine. Should be passed only when vm is
    *        created from a zone with Basic Network support. Mutually exclusive with
    *        securitygroupnames parameter
    * @param string $securityGroupNames comma separated list of security groups names
    *        that going to be applied to the virtual machine. Should be passed only when vm
    *        is created from a zone with Basic Network support. Mutually exclusive with
    *        securitygroupids parameter
    * @param string $size the arbitrary size for the DATADISK volume. Mutually
    *        exclusive with diskOfferingId
    * @param string $startVm true if network offering supports specifying ip ranges;
    *        defaulted to true if not specified
    * @param string $userData an optional binary data that can be sent to the virtual
    *        machine upon a successful deployment. This binary data must be base64 encoded
    *        before adding it to the request. Using HTTP GET (via querystring), you can send
    *        up to 2KB of data after base64 encoding. Using HTTP POST(via POST body), you can
    *        send up to 32K of data after base64 encoding.
    */
    
    public function deployVirtualMachine($serviceOfferingId, $templateId, $zoneId, $account = "", $affinityGroupIds = "", $affinityGroupNames = "", $details = "", $diskOfferingId = "", $displayName = "", $displayVm = "", $domainId = "", $group = "", $hostId = "", $hypervisor = "", $ip6Address = "", $ipAddress = "", $ipToNetWorkList = "", $keyboard = "", $keyPair = "", $name = "", $networkIds = "", $projectId = "", $securityGroupIds = "", $securityGroupNames = "", $size = "", $startVm = "", $userData = "") {

        if (empty($serviceOfferingId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceOfferingId"), MISSING_ARGUMENT);
        }

        if (empty($templateId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "templateId"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("deployVirtualMachine", array(
            'serviceofferingid' => $serviceOfferingId,
            'templateid' => $templateId,
            'zoneid' => $zoneId,
            'account' => $account,
            'affinitygroupids' => $affinityGroupIds,
            'affinitygroupnames' => $affinityGroupNames,
            'details' => $details,
            'diskofferingid' => $diskOfferingId,
            'displayname' => $displayName,
            'displayvm' => $displayVm,
            'domainid' => $domainId,
            'group' => $group,
            'hostid' => $hostId,
            'hypervisor' => $hypervisor,
            'ip6address' => $ip6Address,
            'ipaddress' => $ipAddress,
            'iptonetworklist' => $ipToNetWorkList,
            'keyboard' => $keyboard,
            'keypair' => $keyPair,
            'name' => $name,
            'networkids' => $networkIds,
            'projectid' => $projectId,
            'securitygroupids' => $securityGroupIds,
            'securitygroupnames' => $securityGroupNames,
            'size' => $size,
            'startvm' => $startVm,
            'userdata' => $userData,
        ));
    }
    
    /**
    * Destroys a virtual machine. Once destroyed, only the administrator can recover it.
    *
    * @param string $id The ID of the virtual machine
    * @param string $expunge If true is passed, the vm is expunged immediately. False
    *        by default. Parameter can be passed to the call by ROOT/Domain admin only
    */
    
    public function destroyVirtualMachine($id, $expunge = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("destroyVirtualMachine", array(
            'id' => $id,
            'expunge' => $expunge,
        ));
    }
    
    /**
    * Reboots a virtual machine.
    *
    * @param string $id The ID of the virtual machine
    */
    
    public function rebootVirtualMachine($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("rebootVirtualMachine", array(
            'id' => $id,
        ));
    }
    
    /**
    * Starts a virtual machine.
    *
    * @param string $id The ID of the virtual machine
    * @param string $hostId destination Host ID to deploy the VM to - parameter
    *        available for root admin only
    */
    
    public function startVirtualMachine($id, $hostId = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("startVirtualMachine", array(
            'id' => $id,
            'hostid' => $hostId,
        ));
    }
    
    /**
    * Stops a virtual machine.
    *
    * @param string $id The ID of the virtual machine
    * @param string $forced Force stop the VM (vm is marked as Stopped even when
    *        command fails to be send to the backend).  The caller knows the VM is stopped.
    */
    
    public function stopVirtualMachine($id, $forced = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("stopVirtualMachine", array(
            'id' => $id,
            'forced' => $forced,
        ));
    }
    
    /**
    * Resets the password for virtual machine. The virtual machine must be in a "Stopped" state and the template must already support this feature for this command to take effect. [async]
    *
    * @param string $id The ID of the virtual machine
    */
    
    public function resetPasswordForVirtualMachine($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("resetPasswordForVirtualMachine", array(
            'id' => $id,
        ));
    }
    
    /**
    * Updates properties of a virtual machine. The VM has to be stopped and restarted for the new properties to take effect. UpdateVirtualMachine does not first check whether the VM is stopped. Therefore, stop the VM manually before issuing this call.
    *
    * @param string $id The ID of the virtual machine
    * @param string $displayName user generated name
    * @param string $displayVm an optional field, whether to the display the vm to the
    *        end user or not.
    * @param string $group group of the virtual machine
    * @param string $haEnable true if high-availability is enabled for the virtual
    *        machine, false otherwise
    * @param string $isDynamicallyScalable true if VM contains XS/VMWare tools inorder
    *        to support dynamic scaling of VM cpu/memory
    * @param string $osTypeId the ID of the OS type that best represents this VM.
    * @param string $userData an optional binary data that can be sent to the virtual
    *        machine upon a successful deployment. This binary data must be base64 encoded
    *        before adding it to the request. Using HTTP GET (via querystring), you can send
    *        up to 2KB of data after base64 encoding. Using HTTP POST(via POST body), you can
    *        send up to 32K of data after base64 encoding.
    */
    
    public function updateVirtualMachine($id, $displayName = "", $displayVm = "", $group = "", $haEnable = "", $isDynamicallyScalable = "", $osTypeId = "", $userData = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateVirtualMachine", array(
            'id' => $id,
            'displayname' => $displayName,
            'displayvm' => $displayVm,
            'group' => $group,
            'haenable' => $haEnable,
            'isdynamicallyscalable' => $isDynamicallyScalable,
            'ostypeid' => $osTypeId,
            'userdata' => $userData,
        ));
    }
    
    /**
    * List the virtual machines owned by the account.
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $affinityGroupId list vms by affinity group
    * @param string $details comma separated list of host details requested, value can
    *        be a list of [all, group, nics, stats, secgrp, tmpl, servoff, iso, volume, min,
    *        affgrp]. If no parameter is passed in, the details will be defaulted to all
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $forVirtualNetwork list by network type; true if need to list vms
    *        using Virtual Network, false otherwise
    * @param string $groupId the group ID
    * @param string $hostId the host ID
    * @param string $hypervisor the target hypervisor for the template
    * @param string $id the ID of the virtual machine
    * @param string $isoId list vms by iso
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name name of the virtual machine
    * @param string $networkId list by network id
    * @param string $page 
    * @param string $pageSize 
    * @param string $podId the pod ID
    * @param string $projectId list objects by project
    * @param string $state state of the virtual machine
    * @param string $storageId the storage ID where vm&#039;s volumes belong to
    * @param string $tags List resources by tags (key/value pairs)
    * @param string $templateId list vms by template
    * @param string $vpcId list vms by vpc
    * @param string $zoneId the availability zone ID
    */
    
    public function listVirtualMachines($account = "", $affinityGroupId = "", $details = "", $domainId = "", $forVirtualNetwork = "", $groupId = "", $hostId = "", $hypervisor = "", $id = "", $isoId = "", $isRecursive = "", $keyword = "", $listAll = "", $name = "", $networkId = "", $page = "", $pageSize = "", $podId = "", $projectId = "", $state = "", $storageId = "", $tags = "", $templateId = "", $vpcId = "", $zoneId = "") {

        return $this->request("listVirtualMachines", array(
            'account' => $account,
            'affinitygroupid' => $affinityGroupId,
            'details' => $details,
            'domainid' => $domainId,
            'forvirtualnetwork' => $forVirtualNetwork,
            'groupid' => $groupId,
            'hostid' => $hostId,
            'hypervisor' => $hypervisor,
            'id' => $id,
            'isoid' => $isoId,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'name' => $name,
            'networkid' => $networkId,
            'page' => $page,
            'pagesize' => $pageSize,
            'podid' => $podId,
            'projectid' => $projectId,
            'state' => $state,
            'storageid' => $storageId,
            'tags' => $tags,
            'templateid' => $templateId,
            'vpcid' => $vpcId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Returns an encrypted password for the VM
    *
    * @param string $id The ID of the virtual machine
    */
    
    public function getVMPassword($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("getVMPassword", array(
            'id' => $id,
        ));
    }
    
    /**
    * Restore a VM to original template/ISO or new template/ISO
    *
    * @param string $virtualMachineId Virtual Machine ID
    * @param string $templateId an optional template Id to restore vm from the new
    *        template. This can be an ISO id in case of restore vm deployed using ISO
    */
    
    public function restoreVirtualMachine($virtualMachineId, $templateId = "") {

        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }

        return $this->request("restoreVirtualMachine", array(
            'virtualmachineid' => $virtualMachineId,
            'templateid' => $templateId,
        ));
    }
    
    /**
    * Changes the service offering for a virtual machine. The virtual machine must be in a "Stopped" state for this command to take effect.
    *
    * @param string $id The ID of the virtual machine
    * @param string $serviceOfferingId the service offering ID to apply to the virtual
    *        machine
    * @param string $details name value pairs of custom parameters for cpu, memory and
    *        cpunumber. example details[i].name=value
    */
    
    public function changeServiceForVirtualMachine($id, $serviceOfferingId, $details = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($serviceOfferingId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceOfferingId"), MISSING_ARGUMENT);
        }

        return $this->request("changeServiceForVirtualMachine", array(
            'id' => $id,
            'serviceofferingid' => $serviceOfferingId,
            'details' => $details,
        ));
    }
    
    /**
    * Scales the virtual machine to a new service offering.
    *
    * @param string $id The ID of the virtual machine
    * @param string $serviceOfferingId the ID of the service offering for the virtual
    *        machine
    * @param string $details name value pairs of custom parameters for cpu,memory and
    *        cpunumber. example details[i].name=value
    */
    
    public function scaleVirtualMachine($id, $serviceOfferingId, $details = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($serviceOfferingId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceOfferingId"), MISSING_ARGUMENT);
        }

        return $this->request("scaleVirtualMachine", array(
            'id' => $id,
            'serviceofferingid' => $serviceOfferingId,
            'details' => $details,
        ));
    }
    
    /**
    * Change ownership of a VM from one account to another. This API is available for Basic zones with security groups and Advanced zones with guest networks. A root administrator can reassign a VM from any account to any other account in any domain. A domain administrator can reassign a VM to any account in the same domain.
    *
    * @param string $account account name of the new VM owner.
    * @param string $domainId domain id of the new VM owner.
    * @param string $virtualMachineId id of the VM to be moved
    * @param string $networkIds list of new network ids in which the moved VM will
    *        participate. In case no network ids are provided the VM will be part of the
    *        default network for that zone. In case there is no network yet created for the
    *        new account the default network will be created.
    * @param string $securityGroupIds list of security group ids to be applied on the
    *        virtual machine. In case no security groups are provided the VM is part of the
    *        default security group.
    */
    
    public function assignVirtualMachine($account, $domainId, $virtualMachineId, $networkIds = "", $securityGroupIds = "") {

        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }

        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }

        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }

        return $this->request("assignVirtualMachine", array(
            'account' => $account,
            'domainid' => $domainId,
            'virtualmachineid' => $virtualMachineId,
            'networkids' => $networkIds,
            'securitygroupids' => $securityGroupIds,
        ));
    }
    
    /**
    * Attempts Migration of a VM to a different host or Root volume of the vm to a different storage pool
    *
    * @param string $virtualMachineId the ID of the virtual machine
    * @param string $hostId Destination Host ID to migrate VM to. Required for live
    *        migrating a VM from host to host
    * @param string $storageId Destination storage pool ID to migrate VM volumes to.
    *        Required for migrating the root disk volume
    */
    
    public function migrateVirtualMachine($virtualMachineId, $hostId = "", $storageId = "") {

        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }

        return $this->request("migrateVirtualMachine", array(
            'virtualmachineid' => $virtualMachineId,
            'hostid' => $hostId,
            'storageid' => $storageId,
        ));
    }
    
    /**
    * Attempts Migration of a VM with its volumes to a different host
    *
    * @param string $hostId Destination Host ID to migrate VM to.
    * @param string $virtualMachineId the ID of the virtual machine
    * @param string $migrateTo Map of pool to which each volume should be migrated
    *        (volume/pool pair)
    */
    
    public function migrateVirtualMachineWithVolume($hostId, $virtualMachineId, $migrateTo = "") {

        if (empty($hostId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostId"), MISSING_ARGUMENT);
        }

        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }

        return $this->request("migrateVirtualMachineWithVolume", array(
            'hostid' => $hostId,
            'virtualmachineid' => $virtualMachineId,
            'migrateto' => $migrateTo,
        ));
    }
    
    /**
    * Recovers a virtual machine.
    *
    * @param string $id The ID of the virtual machine
    */
    
    public function recoverVirtualMachine($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("recoverVirtualMachine", array(
            'id' => $id,
        ));
    }
    
    /**
    * Expunge a virtual machine. Once expunged, it cannot be recoverd.
    *
    * @param string $id The ID of the virtual machine
    */
    
    public function expungeVirtualMachine($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("expungeVirtualMachine", array(
            'id' => $id,
        ));
    }
    
    /**
    * Cleanups VM reservations in the database.
    *
    */
    
    public function cleanVMReservations() {

        return $this->request("cleanVMReservations", array(
        ));
    }
    
    /**
    * Adds VM to specified network by creating a NIC
    *
    * @param string $networkId Network ID
    * @param string $virtualMachineId Virtual Machine ID
    * @param string $ipAddress IP Address for the new network
    */
    
    public function addNicToVirtualMachine($networkId, $virtualMachineId, $ipAddress = "") {

        if (empty($networkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkId"), MISSING_ARGUMENT);
        }

        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }

        return $this->request("addNicToVirtualMachine", array(
            'networkid' => $networkId,
            'virtualmachineid' => $virtualMachineId,
            'ipaddress' => $ipAddress,
        ));
    }
    
    /**
    * Removes VM from specified network by deleting a NIC
    *
    * @param string $nicId NIC ID
    * @param string $virtualMachineId Virtual Machine ID
    */
    
    public function removeNicFromVirtualMachine($nicId, $virtualMachineId) {

        if (empty($nicId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nicId"), MISSING_ARGUMENT);
        }

        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }

        return $this->request("removeNicFromVirtualMachine", array(
            'nicid' => $nicId,
            'virtualmachineid' => $virtualMachineId,
        ));
    }
    
    /**
    * Changes the default NIC on a VM
    *
    * @param string $nicId NIC ID
    * @param string $virtualMachineId Virtual Machine ID
    */
    
    public function updateDefaultNicForVirtualMachine($nicId, $virtualMachineId) {

        if (empty($nicId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nicId"), MISSING_ARGUMENT);
        }

        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }

        return $this->request("updateDefaultNicForVirtualMachine", array(
            'nicid' => $nicId,
            'virtualmachineid' => $virtualMachineId,
        ));
    }
    
    /**
    * Adds metric counter
    *
    * @param string $name Name of the counter.
    * @param string $source Source of the counter.
    * @param string $value Value of the counter e.g. oid in case of snmp.
    */
    
    public function createCounter($name, $source, $value) {

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($source)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "source"), MISSING_ARGUMENT);
        }

        if (empty($value)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "value"), MISSING_ARGUMENT);
        }

        return $this->request("createCounter", array(
            'name' => $name,
            'source' => $source,
            'value' => $value,
        ));
    }
    
    /**
    * Creates a condition
    *
    * @param string $counterId ID of the Counter.
    * @param string $relationalOperator Relational Operator to be used with
    *        threshold.
    * @param string $threshold Threshold value.
    * @param string $account the account of the condition. Must be used with the
    *        domainId parameter.
    * @param string $domainId the domain ID of the account.
    */
    
    public function createCondition($counterId, $relationalOperator, $threshold, $account = "", $domainId = "") {

        if (empty($counterId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "counterId"), MISSING_ARGUMENT);
        }

        if (empty($relationalOperator)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "relationalOperator"), MISSING_ARGUMENT);
        }

        if (empty($threshold)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "threshold"), MISSING_ARGUMENT);
        }

        return $this->request("createCondition", array(
            'counterid' => $counterId,
            'relationaloperator' => $relationalOperator,
            'threshold' => $threshold,
            'account' => $account,
            'domainid' => $domainId,
        ));
    }
    
    /**
    * Creates an autoscale policy for a provision or deprovision action, the action is taken when the all the conditions evaluates to true for the specified duration. The policy is in effect once it is attached to a autscale vm group.
    *
    * @param string $action the action to be executed if all the conditions evaluate
    *        to true for the specified duration.
    * @param string $conditionIds the list of IDs of the conditions that are being
    *        evaluated on every interval
    * @param string $duration the duration for which the conditions have to be true
    *        before action is taken
    * @param string $quietTime the cool down period for which the policy should not be
    *        evaluated after the action has been taken
    */
    
    public function createAutoScalePolicy($action, $conditionIds, $duration, $quietTime = "") {

        if (empty($action)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "action"), MISSING_ARGUMENT);
        }

        if (empty($conditionIds)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "conditionIds"), MISSING_ARGUMENT);
        }

        if (empty($duration)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "duration"), MISSING_ARGUMENT);
        }

        return $this->request("createAutoScalePolicy", array(
            'action' => $action,
            'conditionids' => $conditionIds,
            'duration' => $duration,
            'quiettime' => $quietTime,
        ));
    }
    
    /**
    * Creates a profile that contains information about the virtual machine which will be provisioned automatically by autoscale feature.
    *
    * @param string $serviceOfferingId the service offering of the auto deployed
    *        virtual machine
    * @param string $templateId the template of the auto deployed virtual machine
    * @param string $zoneId availability zone for the auto deployed virtual machine
    * @param string $autoScaleUserId the ID of the user used to launch and destroy the
    *        VMs
    * @param string $counterParam counterparam list. Example:
    *        counterparam[0].name=snmpcommunity&amp;amp;counterparam[0].value=public&amp;amp;
    *        counterparam[1].name=snmpport&amp;amp;counterparam[1].value=161
    * @param string $destroyVmGracePeriod the time allowed for existing connections to
    *        get closed before a vm is destroyed
    * @param string $otherDeployParams parameters other than
    *        zoneId/serviceOfferringId/templateId of the auto deployed virtual machine
    */
    
    public function createAutoScaleVmProfile($serviceOfferingId, $templateId, $zoneId, $autoScaleUserId = "", $counterParam = "", $destroyVmGracePeriod = "", $otherDeployParams = "") {

        if (empty($serviceOfferingId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceOfferingId"), MISSING_ARGUMENT);
        }

        if (empty($templateId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "templateId"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("createAutoScaleVmProfile", array(
            'serviceofferingid' => $serviceOfferingId,
            'templateid' => $templateId,
            'zoneid' => $zoneId,
            'autoscaleuserid' => $autoScaleUserId,
            'counterparam' => $counterParam,
            'destroyvmgraceperiod' => $destroyVmGracePeriod,
            'otherdeployparams' => $otherDeployParams,
        ));
    }
    
    /**
    * Creates and automatically starts a virtual machine based on a service offering, disk offering, and template.
    *
    * @param string $lbruleId the ID of the load balancer rule
    * @param string $maxMembers the maximum number of members in the vmgroup, The
    *        number of instances in the vm group will be equal to or less than this number.
    * @param string $minMembers the minimum number of members in the vmgroup, the
    *        number of instances in the vm group will be equal to or more than this number.
    * @param string $scaleDownPolicyIds list of scaledown autoscale policies
    * @param string $scaleUpPolicyIds list of scaleup autoscale policies
    * @param string $vmProfileId the autoscale profile that contains information about
    *        the vms in the vm group.
    * @param string $interval the frequency at which the conditions have to be
    *        evaluated
    */
    
    public function createAutoScaleVmGroup($lbruleId, $maxMembers, $minMembers, $scaleDownPolicyIds, $scaleUpPolicyIds, $vmProfileId, $interval = "") {

        if (empty($lbruleId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleId"), MISSING_ARGUMENT);
        }

        if (empty($maxMembers)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "maxMembers"), MISSING_ARGUMENT);
        }

        if (empty($minMembers)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "minMembers"), MISSING_ARGUMENT);
        }

        if (empty($scaleDownPolicyIds)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "scaleDownPolicyIds"), MISSING_ARGUMENT);
        }

        if (empty($scaleUpPolicyIds)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "scaleUpPolicyIds"), MISSING_ARGUMENT);
        }

        if (empty($vmProfileId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vmProfileId"), MISSING_ARGUMENT);
        }

        return $this->request("createAutoScaleVmGroup", array(
            'lbruleid' => $lbruleId,
            'maxmembers' => $maxMembers,
            'minmembers' => $minMembers,
            'scaledownpolicyids' => $scaleDownPolicyIds,
            'scaleuppolicyids' => $scaleUpPolicyIds,
            'vmprofileid' => $vmProfileId,
            'interval' => $interval,
        ));
    }
    
    /**
    * Deletes a counter
    *
    * @param string $id the ID of the counter
    */
    
    public function deleteCounter($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteCounter", array(
            'id' => $id,
        ));
    }
    
    /**
    * Removes a condition
    *
    * @param string $id the ID of the condition.
    */
    
    public function deleteCondition($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteCondition", array(
            'id' => $id,
        ));
    }
    
    /**
    * Deletes a autoscale policy.
    *
    * @param string $id the ID of the autoscale policy
    */
    
    public function deleteAutoScalePolicy($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteAutoScalePolicy", array(
            'id' => $id,
        ));
    }
    
    /**
    * Deletes a autoscale vm profile.
    *
    * @param string $id the ID of the autoscale profile
    */
    
    public function deleteAutoScaleVmProfile($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteAutoScaleVmProfile", array(
            'id' => $id,
        ));
    }
    
    /**
    * Deletes a autoscale vm group.
    *
    * @param string $id the ID of the autoscale group
    */
    
    public function deleteAutoScaleVmGroup($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteAutoScaleVmGroup", array(
            'id' => $id,
        ));
    }
    
    /**
    * List the counters
    *
    * @param string $id ID of the Counter.
    * @param string $keyword List by keyword
    * @param string $name Name of the counter.
    * @param string $page 
    * @param string $pageSize 
    * @param string $source Source of the counter.
    */
    
    public function listCounters($id = "", $keyword = "", $name = "", $page = "", $pageSize = "", $source = "") {

        return $this->request("listCounters", array(
            'id' => $id,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'source' => $source,
        ));
    }
    
    /**
    * List Conditions for the specific user
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $counterId Counter-id of the condition.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id ID of the Condition.
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $policyId the ID of the policy
    */
    
    public function listConditions($account = "", $counterId = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $policyId = "") {

        return $this->request("listConditions", array(
            'account' => $account,
            'counterid' => $counterId,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'policyid' => $policyId,
        ));
    }
    
    /**
    * Lists autoscale policies.
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $action the action to be executed if all the conditions evaluate
    *        to true for the specified duration.
    * @param string $conditionId the ID of the condition of the policy
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id the ID of the autoscale policy
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $vmGroupId the ID of the autoscale vm group
    */
    
    public function listAutoScalePolicies($account = "", $action = "", $conditionId = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $vmGroupId = "") {

        return $this->request("listAutoScalePolicies", array(
            'account' => $account,
            'action' => $action,
            'conditionid' => $conditionId,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'vmgroupid' => $vmGroupId,
        ));
    }
    
    /**
    * Lists autoscale vm profiles.
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id the ID of the autoscale vm profile
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $otherDeployParams the otherdeployparameters of the autoscale vm
    *        profile
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $templateId the templateid of the autoscale vm profile
    */
    
    public function listAutoScaleVmProfiles($account = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $otherDeployParams = "", $page = "", $pageSize = "", $projectId = "", $templateId = "") {

        return $this->request("listAutoScaleVmProfiles", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'otherdeployparams' => $otherDeployParams,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'templateid' => $templateId,
        ));
    }
    
    /**
    * Lists autoscale vm groups.
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id the ID of the autoscale vm group
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $lbruleId the ID of the loadbalancer
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $policyId the ID of the policy
    * @param string $projectId list objects by project
    * @param string $vmProfileId the ID of the profile
    * @param string $zoneId the availability zone ID
    */
    
    public function listAutoScaleVmGroups($account = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $lbruleId = "", $listAll = "", $page = "", $pageSize = "", $policyId = "", $projectId = "", $vmProfileId = "", $zoneId = "") {

        return $this->request("listAutoScaleVmGroups", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'lbruleid' => $lbruleId,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'policyid' => $policyId,
            'projectid' => $projectId,
            'vmprofileid' => $vmProfileId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Enables an AutoScale Vm Group
    *
    * @param string $id the ID of the autoscale group
    */
    
    public function enableAutoScaleVmGroup($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("enableAutoScaleVmGroup", array(
            'id' => $id,
        ));
    }
    
    /**
    * Disables an AutoScale Vm Group
    *
    * @param string $id the ID of the autoscale group
    */
    
    public function disableAutoScaleVmGroup($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("disableAutoScaleVmGroup", array(
            'id' => $id,
        ));
    }
    
    /**
    * Updates an existing autoscale policy.
    *
    * @param string $id the ID of the autoscale policy
    * @param string $conditionIds the list of IDs of the conditions that are being
    *        evaluated on every interval
    * @param string $duration the duration for which the conditions have to be true
    *        before action is taken
    * @param string $quietTime the cool down period for which the policy should not be
    *        evaluated after the action has been taken
    */
    
    public function updateAutoScalePolicy($id, $conditionIds = "", $duration = "", $quietTime = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateAutoScalePolicy", array(
            'id' => $id,
            'conditionids' => $conditionIds,
            'duration' => $duration,
            'quiettime' => $quietTime,
        ));
    }
    
    /**
    * Updates an existing autoscale vm profile.
    *
    * @param string $id the ID of the autoscale vm profile
    * @param string $autoScaleUserId the ID of the user used to launch and destroy the
    *        VMs
    * @param string $counterParam counterparam list. Example:
    *        counterparam[0].name=snmpcommunity&amp;amp;counterparam[0].value=public&amp;amp;
    *        counterparam[1].name=snmpport&amp;amp;counterparam[1].value=161
    * @param string $destroyVmGracePeriod the time allowed for existing connections to
    *        get closed before a vm is destroyed
    * @param string $templateId the template of the auto deployed virtual machine
    */
    
    public function updateAutoScaleVmProfile($id, $autoScaleUserId = "", $counterParam = "", $destroyVmGracePeriod = "", $templateId = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateAutoScaleVmProfile", array(
            'id' => $id,
            'autoscaleuserid' => $autoScaleUserId,
            'counterparam' => $counterParam,
            'destroyvmgraceperiod' => $destroyVmGracePeriod,
            'templateid' => $templateId,
        ));
    }
    
    /**
    * Updates an existing autoscale vm group.
    *
    * @param string $id the ID of the autoscale group
    * @param string $interval the frequency at which the conditions have to be
    *        evaluated
    * @param string $maxMembers the maximum number of members in the vmgroup, The
    *        number of instances in the vm group will be equal to or less than this number.
    * @param string $minMembers the minimum number of members in the vmgroup, the
    *        number of instances in the vm group will be equal to or more than this number.
    * @param string $scaleDownPolicyIds list of scaledown autoscale policies
    * @param string $scaleUpPolicyIds list of scaleup autoscale policies
    */
    
    public function updateAutoScaleVmGroup($id, $interval = "", $maxMembers = "", $minMembers = "", $scaleDownPolicyIds = "", $scaleUpPolicyIds = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateAutoScaleVmGroup", array(
            'id' => $id,
            'interval' => $interval,
            'maxmembers' => $maxMembers,
            'minmembers' => $minMembers,
            'scaledownpolicyids' => $scaleDownPolicyIds,
            'scaleuppolicyids' => $scaleUpPolicyIds,
        ));
    }
    
    /**
    * Lists all port forwarding rules for an IP address.
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id Lists rule with the specified ID.
    * @param string $ipAddressId the id of IP address of the port forwarding services
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $networkId list port forwarding rules for ceratin network
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $tags List resources by tags (key/value pairs)
    */
    
    public function listPortForwardingRules($account = "", $domainId = "", $id = "", $ipAddressId = "", $isRecursive = "", $keyword = "", $listAll = "", $networkId = "", $page = "", $pageSize = "", $projectId = "", $tags = "") {

        return $this->request("listPortForwardingRules", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'ipaddressid' => $ipAddressId,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'networkid' => $networkId,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'tags' => $tags,
        ));
    }
    
    /**
    * Creates a port forwarding rule
    *
    * @param string $ipAddressId the IP address id of the port forwarding rule
    * @param string $privatePort the starting port of port forwarding rule&#039;s
    *        private port range
    * @param string $protocol the protocol for the port fowarding rule. Valid values
    *        are TCP or UDP.
    * @param string $publicPort the starting port of port forwarding rule&#039;s
    *        public port range
    * @param string $virtualMachineId the ID of the virtual machine for the port
    *        forwarding rule
    * @param string $cidrList the cidr list to forward traffic from
    * @param string $networkId The network of the vm the Port Forwarding rule will be
    *        created for. Required when public Ip address is not associated with any Guest
    *        network yet (VPC case)
    * @param string $openFirewall if true, firewall rule for source/end pubic port is
    *        automatically created; if false - firewall rule has to be created explicitely.
    *        If not specified 1) defaulted to false when PF rule is being created for VPC
    *        guest network 2) in all other cases defaulted to true
    * @param string $privateEndPort the ending port of port forwarding rule&#039;s
    *        private port range
    * @param string $publicEndPort the ending port of port forwarding rule&#039;s
    *        private port range
    * @param string $vmGuestIp VM guest nic Secondary ip address for the port
    *        forwarding rule
    */
    
    public function createPortForwardingRule($ipAddressId, $privatePort, $protocol, $publicPort, $virtualMachineId, $cidrList = "", $networkId = "", $openFirewall = "", $privateEndPort = "", $publicEndPort = "", $vmGuestIp = "") {

        if (empty($ipAddressId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipAddressId"), MISSING_ARGUMENT);
        }

        if (empty($privatePort)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "privatePort"), MISSING_ARGUMENT);
        }

        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "protocol"), MISSING_ARGUMENT);
        }

        if (empty($publicPort)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "publicPort"), MISSING_ARGUMENT);
        }

        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }

        return $this->request("createPortForwardingRule", array(
            'ipaddressid' => $ipAddressId,
            'privateport' => $privatePort,
            'protocol' => $protocol,
            'publicport' => $publicPort,
            'virtualmachineid' => $virtualMachineId,
            'cidrlist' => $cidrList,
            'networkid' => $networkId,
            'openfirewall' => $openFirewall,
            'privateendport' => $privateEndPort,
            'publicendport' => $publicEndPort,
            'vmguestip' => $vmGuestIp,
        ));
    }
    
    /**
    * Deletes a port forwarding rule
    *
    * @param string $id the ID of the port forwarding rule
    */
    
    public function deletePortForwardingRule($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deletePortForwardingRule", array(
            'id' => $id,
        ));
    }
    
    /**
    * Updates a port forwarding rule.  Only the private port and the virtual machine can be updated.
    *
    * @param string $ipAddressId the IP address id of the port forwarding rule
    * @param string $privatePort the private port of the port forwarding rule
    * @param string $protocol the protocol for the port fowarding rule. Valid values
    *        are TCP or UDP.
    * @param string $publicPort the public port of the port forwarding rule
    * @param string $privateIp the private IP address of the port forwarding rule
    * @param string $virtualMachineId the ID of the virtual machine for the port
    *        forwarding rule
    */
    
    public function updatePortForwardingRule($ipAddressId, $privatePort, $protocol, $publicPort, $privateIp = "", $virtualMachineId = "") {

        if (empty($ipAddressId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipAddressId"), MISSING_ARGUMENT);
        }

        if (empty($privatePort)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "privatePort"), MISSING_ARGUMENT);
        }

        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "protocol"), MISSING_ARGUMENT);
        }

        if (empty($publicPort)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "publicPort"), MISSING_ARGUMENT);
        }

        return $this->request("updatePortForwardingRule", array(
            'ipaddressid' => $ipAddressId,
            'privateport' => $privatePort,
            'protocol' => $protocol,
            'publicport' => $publicPort,
            'privateip' => $privateIp,
            'virtualmachineid' => $virtualMachineId,
        ));
    }
    
    /**
    * Creates a firewall rule for a given ip address
    *
    * @param string $ipAddressId the IP address id of the port forwarding rule
    * @param string $protocol the protocol for the firewall rule. Valid values are
    *        TCP/UDP/ICMP.
    * @param string $cidrList the cidr list to forward traffic from
    * @param string $endPort the ending port of firewall rule
    * @param string $icmpCode error code for this icmp message
    * @param string $icmpType type of the icmp message being sent
    * @param string $startPort the starting port of firewall rule
    * @param string $type type of firewallrule: system/user
    */
    
    public function createFirewallRule($ipAddressId, $protocol, $cidrList = "", $endPort = "", $icmpCode = "", $icmpType = "", $startPort = "", $type = "") {

        if (empty($ipAddressId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipAddressId"), MISSING_ARGUMENT);
        }

        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "protocol"), MISSING_ARGUMENT);
        }

        return $this->request("createFirewallRule", array(
            'ipaddressid' => $ipAddressId,
            'protocol' => $protocol,
            'cidrlist' => $cidrList,
            'endport' => $endPort,
            'icmpcode' => $icmpCode,
            'icmptype' => $icmpType,
            'startport' => $startPort,
            'type' => $type,
        ));
    }
    
    /**
    * Deletes a firewall rule
    *
    * @param string $id the ID of the firewall rule
    */
    
    public function deleteFirewallRule($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteFirewallRule", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists all firewall rules for an IP address.
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id Lists rule with the specified ID.
    * @param string $ipAddressId the id of IP address of the firwall services
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $networkId list firewall rules for ceratin network
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $tags List resources by tags (key/value pairs)
    */
    
    public function listFirewallRules($account = "", $domainId = "", $id = "", $ipAddressId = "", $isRecursive = "", $keyword = "", $listAll = "", $networkId = "", $page = "", $pageSize = "", $projectId = "", $tags = "") {

        return $this->request("listFirewallRules", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'ipaddressid' => $ipAddressId,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'networkid' => $networkId,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'tags' => $tags,
        ));
    }
    
    /**
    * Creates a egress firewall rule for a given network
    *
    * @param string $networkId the network id of the port forwarding rule
    * @param string $protocol the protocol for the firewall rule. Valid values are
    *        TCP/UDP/ICMP.
    * @param string $cidrList the cidr list to forward traffic from
    * @param string $endPort the ending port of firewall rule
    * @param string $icmpCode error code for this icmp message
    * @param string $icmpType type of the icmp message being sent
    * @param string $startPort the starting port of firewall rule
    * @param string $type type of firewallrule: system/user
    */
    
    public function createEgressFirewallRule($networkId, $protocol, $cidrList = "", $endPort = "", $icmpCode = "", $icmpType = "", $startPort = "", $type = "") {

        if (empty($networkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkId"), MISSING_ARGUMENT);
        }

        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "protocol"), MISSING_ARGUMENT);
        }

        return $this->request("createEgressFirewallRule", array(
            'networkid' => $networkId,
            'protocol' => $protocol,
            'cidrlist' => $cidrList,
            'endport' => $endPort,
            'icmpcode' => $icmpCode,
            'icmptype' => $icmpType,
            'startport' => $startPort,
            'type' => $type,
        ));
    }
    
    /**
    * Deletes an ggress firewall rule
    *
    * @param string $id the ID of the firewall rule
    */
    
    public function deleteEgressFirewallRule($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteEgressFirewallRule", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists all egress firewall rules for network id.
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id Lists rule with the specified ID.
    * @param string $id Lists rule with the specified ID.
    * @param string $ipAddressId the id of IP address of the firwall services
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $networkId list firewall rules for ceratin network
    * @param string $networkId the id network network for the egress firwall services
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $tags List resources by tags (key/value pairs)
    */
    
    public function listEgressFirewallRules($account = "", $domainId = "", $id = "", $id = "", $ipAddressId = "", $isRecursive = "", $keyword = "", $listAll = "", $networkId = "", $networkId = "", $page = "", $pageSize = "", $projectId = "", $tags = "") {

        return $this->request("listEgressFirewallRules", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'id' => $id,
            'ipaddressid' => $ipAddressId,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'networkid' => $networkId,
            'networkid' => $networkId,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'tags' => $tags,
        ));
    }
    
    /**
    * Adds a SRX firewall device
    *
    * @param string $networkDeviceType supports only JuniperSRXFirewall
    * @param string $password Credentials to reach SRX firewall device
    * @param string $physicalNetworkId the Physical Network ID
    * @param string $url URL of the SRX appliance.
    * @param string $userName Credentials to reach SRX firewall device
    */
    
    public function addSrxFirewall($networkDeviceType, $password, $physicalNetworkId, $url, $userName) {

        if (empty($networkDeviceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkDeviceType"), MISSING_ARGUMENT);
        }

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        return $this->request("addSrxFirewall", array(
            'networkdevicetype' => $networkDeviceType,
            'password' => $password,
            'physicalnetworkid' => $physicalNetworkId,
            'url' => $url,
            'username' => $userName,
        ));
    }
    
    /**
    * delete a SRX firewall device
    *
    * @param string $fwDeviceId srx firewall device ID
    */
    
    public function deleteSrxFirewall($fwDeviceId) {

        if (empty($fwDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "fwDeviceId"), MISSING_ARGUMENT);
        }

        return $this->request("deleteSrxFirewall", array(
            'fwdeviceid' => $fwDeviceId,
        ));
    }
    
    /**
    * Configures a SRX firewall device
    *
    * @param string $fwDeviceId SRX firewall device ID
    * @param string $fwDeviceCapacity capacity of the firewall device, Capacity will
    *        be interpreted as number of networks device can handle
    */
    
    public function configureSrxFirewall($fwDeviceId, $fwDeviceCapacity = "") {

        if (empty($fwDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "fwDeviceId"), MISSING_ARGUMENT);
        }

        return $this->request("configureSrxFirewall", array(
            'fwdeviceid' => $fwDeviceId,
            'fwdevicecapacity' => $fwDeviceCapacity,
        ));
    }
    
    /**
    * lists SRX firewall devices in a physical network
    *
    * @param string $fwDeviceId SRX firewall device ID
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $physicalNetworkId the Physical Network ID
    */
    
    public function listSrxFirewalls($fwDeviceId = "", $keyword = "", $page = "", $pageSize = "", $physicalNetworkId = "") {

        return $this->request("listSrxFirewalls", array(
            'fwdeviceid' => $fwDeviceId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'physicalnetworkid' => $physicalNetworkId,
        ));
    }
    
    /**
    * Adds a Palo Alto firewall device
    *
    * @param string $networkDeviceType supports only PaloAltoFirewall
    * @param string $password Credentials to reach Palo Alto firewall device
    * @param string $physicalNetworkId the Physical Network ID
    * @param string $url URL of the Palo Alto appliance.
    * @param string $userName Credentials to reach Palo Alto firewall device
    */
    
    public function addPaloAltoFirewall($networkDeviceType, $password, $physicalNetworkId, $url, $userName) {

        if (empty($networkDeviceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkDeviceType"), MISSING_ARGUMENT);
        }

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        return $this->request("addPaloAltoFirewall", array(
            'networkdevicetype' => $networkDeviceType,
            'password' => $password,
            'physicalnetworkid' => $physicalNetworkId,
            'url' => $url,
            'username' => $userName,
        ));
    }
    
    /**
    * delete a Palo Alto firewall device
    *
    * @param string $fwDeviceId Palo Alto firewall device ID
    */
    
    public function deletePaloAltoFirewall($fwDeviceId) {

        if (empty($fwDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "fwDeviceId"), MISSING_ARGUMENT);
        }

        return $this->request("deletePaloAltoFirewall", array(
            'fwdeviceid' => $fwDeviceId,
        ));
    }
    
    /**
    * Configures a Palo Alto firewall device
    *
    * @param string $fwDeviceId Palo Alto firewall device ID
    * @param string $fwDeviceCapacity capacity of the firewall device, Capacity will
    *        be interpreted as number of networks device can handle
    */
    
    public function configurePaloAltoFirewall($fwDeviceId, $fwDeviceCapacity = "") {

        if (empty($fwDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "fwDeviceId"), MISSING_ARGUMENT);
        }

        return $this->request("configurePaloAltoFirewall", array(
            'fwdeviceid' => $fwDeviceId,
            'fwdevicecapacity' => $fwDeviceCapacity,
        ));
    }
    
    /**
    * lists Palo Alto firewall devices in a physical network
    *
    * @param string $fwDeviceId Palo Alto firewall device ID
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $physicalNetworkId the Physical Network ID
    */
    
    public function listPaloAltoFirewalls($fwDeviceId = "", $keyword = "", $page = "", $pageSize = "", $physicalNetworkId = "") {

        return $this->request("listPaloAltoFirewalls", array(
            'fwdeviceid' => $fwDeviceId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'physicalnetworkid' => $physicalNetworkId,
        ));
    }
    
    /**
    * Creates a l2tp/ipsec remote access vpn
    *
    * @param string $publicIpId public ip address id of the vpn server
    * @param string $account an optional account for the VPN. Must be used with
    *        domainId.
    * @param string $domainId an optional domainId for the VPN. If the account
    *        parameter is used, domainId must also be used.
    * @param string $ipRange the range of ip addresses to allocate to vpn clients. The
    *        first ip in the range will be taken by the vpn server
    * @param string $openFirewall if true, firewall rule for source/end pubic port is
    *        automatically created; if false - firewall rule has to be created explicitely.
    *        Has value true by default
    */
    
    public function createRemoteAccessVpn($publicIpId, $account = "", $domainId = "", $ipRange = "", $openFirewall = "") {

        if (empty($publicIpId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "publicIpId"), MISSING_ARGUMENT);
        }

        return $this->request("createRemoteAccessVpn", array(
            'publicipid' => $publicIpId,
            'account' => $account,
            'domainid' => $domainId,
            'iprange' => $ipRange,
            'openfirewall' => $openFirewall,
        ));
    }
    
    /**
    * Destroys a l2tp/ipsec remote access vpn
    *
    * @param string $publicIpId public ip address id of the vpn server
    */
    
    public function deleteRemoteAccessVpn($publicIpId) {

        if (empty($publicIpId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "publicIpId"), MISSING_ARGUMENT);
        }

        return $this->request("deleteRemoteAccessVpn", array(
            'publicipid' => $publicIpId,
        ));
    }
    
    /**
    * Lists remote access vpns
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id Lists remote access vpn rule with the specified ID
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $networkId list remote access VPNs for ceratin network
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $publicIpId public ip address id of the vpn server
    */
    
    public function listRemoteAccessVpns($account = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $networkId = "", $page = "", $pageSize = "", $projectId = "", $publicIpId = "") {

        return $this->request("listRemoteAccessVpns", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'networkid' => $networkId,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'publicipid' => $publicIpId,
        ));
    }
    
    /**
    * Adds vpn users
    *
    * @param string $password password for the username
    * @param string $userName username for the vpn user
    * @param string $account an optional account for the vpn user. Must be used with
    *        domainId.
    * @param string $domainId an optional domainId for the vpn user. If the account
    *        parameter is used, domainId must also be used.
    * @param string $projectId add vpn user to the specific project
    */
    
    public function addVpnUser($password, $userName, $account = "", $domainId = "", $projectId = "") {

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        return $this->request("addVpnUser", array(
            'password' => $password,
            'username' => $userName,
            'account' => $account,
            'domainid' => $domainId,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * Removes vpn user
    *
    * @param string $userName username for the vpn user
    * @param string $account an optional account for the vpn user. Must be used with
    *        domainId.
    * @param string $domainId an optional domainId for the vpn user. If the account
    *        parameter is used, domainId must also be used.
    * @param string $projectId remove vpn user from the project
    */
    
    public function removeVpnUser($userName, $account = "", $domainId = "", $projectId = "") {

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        return $this->request("removeVpnUser", array(
            'username' => $userName,
            'account' => $account,
            'domainid' => $domainId,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * Lists vpn users
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id The uuid of the Vpn user
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $userName the username of the vpn user.
    */
    
    public function listVpnUsers($account = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $projectId = "", $userName = "") {

        return $this->request("listVpnUsers", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'username' => $userName,
        ));
    }
    
    /**
    * Creates site to site vpn customer gateway
    *
    * @param string $cidrList guest cidr list of the customer gateway
    * @param string $espPolicy ESP policy of the customer gateway
    * @param string $gateway public ip address id of the customer gateway
    * @param string $ikePolicy IKE policy of the customer gateway
    * @param string $ipsecPsk IPsec Preshared-Key of the customer gateway
    * @param string $account the account associated with the gateway. Must be used
    *        with the domainId parameter.
    * @param string $domainId the domain ID associated with the gateway. If used with
    *        the account parameter returns the gateway associated with the account for the
    *        specified domain.
    * @param string $dpd If DPD is enabled for VPN connection
    * @param string $espLifetime Lifetime of phase 2 VPN connection to the customer
    *        gateway, in seconds
    * @param string $ikeLifetime Lifetime of phase 1 VPN connection to the customer
    *        gateway, in seconds
    * @param string $name name of this customer gateway
    */
    
    public function createVpnCustomerGateway($cidrList, $espPolicy, $gateway, $ikePolicy, $ipsecPsk, $account = "", $domainId = "", $dpd = "", $espLifetime = "", $ikeLifetime = "", $name = "") {

        if (empty($cidrList)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "cidrList"), MISSING_ARGUMENT);
        }

        if (empty($espPolicy)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "espPolicy"), MISSING_ARGUMENT);
        }

        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gateway"), MISSING_ARGUMENT);
        }

        if (empty($ikePolicy)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ikePolicy"), MISSING_ARGUMENT);
        }

        if (empty($ipsecPsk)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipsecPsk"), MISSING_ARGUMENT);
        }

        return $this->request("createVpnCustomerGateway", array(
            'cidrlist' => $cidrList,
            'esppolicy' => $espPolicy,
            'gateway' => $gateway,
            'ikepolicy' => $ikePolicy,
            'ipsecpsk' => $ipsecPsk,
            'account' => $account,
            'domainid' => $domainId,
            'dpd' => $dpd,
            'esplifetime' => $espLifetime,
            'ikelifetime' => $ikeLifetime,
            'name' => $name,
        ));
    }
    
    /**
    * Creates site to site vpn local gateway
    *
    * @param string $vpcId public ip address id of the vpn gateway
    */
    
    public function createVpnGateway($vpcId) {

        if (empty($vpcId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vpcId"), MISSING_ARGUMENT);
        }

        return $this->request("createVpnGateway", array(
            'vpcid' => $vpcId,
        ));
    }
    
    /**
    * Create site to site vpn connection
    *
    * @param string $s2sCustomerGatewayId id of the customer gateway
    * @param string $s2sVpnGatewayId id of the vpn gateway
    * @param string $passive connection is passive or not
    */
    
    public function createVpnConnection($s2sCustomerGatewayId, $s2sVpnGatewayId, $passive = "") {

        if (empty($s2sCustomerGatewayId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "s2sCustomerGatewayId"), MISSING_ARGUMENT);
        }

        if (empty($s2sVpnGatewayId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "s2sVpnGatewayId"), MISSING_ARGUMENT);
        }

        return $this->request("createVpnConnection", array(
            's2scustomergatewayid' => $s2sCustomerGatewayId,
            's2svpngatewayid' => $s2sVpnGatewayId,
            'passive' => $passive,
        ));
    }
    
    /**
    * Delete site to site vpn customer gateway
    *
    * @param string $id id of customer gateway
    */
    
    public function deleteVpnCustomerGateway($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteVpnCustomerGateway", array(
            'id' => $id,
        ));
    }
    
    /**
    * Delete site to site vpn gateway
    *
    * @param string $id id of customer gateway
    */
    
    public function deleteVpnGateway($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteVpnGateway", array(
            'id' => $id,
        ));
    }
    
    /**
    * Delete site to site vpn connection
    *
    * @param string $id id of vpn connection
    */
    
    public function deleteVpnConnection($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteVpnConnection", array(
            'id' => $id,
        ));
    }
    
    /**
    * Update site to site vpn customer gateway
    *
    * @param string $id id of customer gateway
    * @param string $cidrList guest cidr of the customer gateway
    * @param string $espPolicy ESP policy of the customer gateway
    * @param string $gateway public ip address id of the customer gateway
    * @param string $ikePolicy IKE policy of the customer gateway
    * @param string $ipsecPsk IPsec Preshared-Key of the customer gateway
    * @param string $account the account associated with the gateway. Must be used
    *        with the domainId parameter.
    * @param string $domainId the domain ID associated with the gateway. If used with
    *        the account parameter returns the gateway associated with the account for the
    *        specified domain.
    * @param string $dpd If DPD is enabled for VPN connection
    * @param string $espLifetime Lifetime of phase 2 VPN connection to the customer
    *        gateway, in seconds
    * @param string $ikeLifetime Lifetime of phase 1 VPN connection to the customer
    *        gateway, in seconds
    * @param string $name name of this customer gateway
    */
    
    public function updateVpnCustomerGateway($id, $cidrList, $espPolicy, $gateway, $ikePolicy, $ipsecPsk, $account = "", $domainId = "", $dpd = "", $espLifetime = "", $ikeLifetime = "", $name = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($cidrList)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "cidrList"), MISSING_ARGUMENT);
        }

        if (empty($espPolicy)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "espPolicy"), MISSING_ARGUMENT);
        }

        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gateway"), MISSING_ARGUMENT);
        }

        if (empty($ikePolicy)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ikePolicy"), MISSING_ARGUMENT);
        }

        if (empty($ipsecPsk)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipsecPsk"), MISSING_ARGUMENT);
        }

        return $this->request("updateVpnCustomerGateway", array(
            'id' => $id,
            'cidrlist' => $cidrList,
            'esppolicy' => $espPolicy,
            'gateway' => $gateway,
            'ikepolicy' => $ikePolicy,
            'ipsecpsk' => $ipsecPsk,
            'account' => $account,
            'domainid' => $domainId,
            'dpd' => $dpd,
            'esplifetime' => $espLifetime,
            'ikelifetime' => $ikeLifetime,
            'name' => $name,
        ));
    }
    
    /**
    * Reset site to site vpn connection
    *
    * @param string $id id of vpn connection
    * @param string $account an optional account for connection. Must be used with
    *        domainId.
    * @param string $domainId an optional domainId for connection. If the account
    *        parameter is used, domainId must also be used.
    */
    
    public function resetVpnConnection($id, $account = "", $domainId = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("resetVpnConnection", array(
            'id' => $id,
            'account' => $account,
            'domainid' => $domainId,
        ));
    }
    
    /**
    * Lists site to site vpn customer gateways
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id id of the customer gateway
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    */
    
    public function listVpnCustomerGateways($account = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $projectId = "") {

        return $this->request("listVpnCustomerGateways", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * Lists site 2 site vpn gateways
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id id of the vpn gateway
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $vpcId id of vpc
    */
    
    public function listVpnGateways($account = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $projectId = "", $vpcId = "") {

        return $this->request("listVpnGateways", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'vpcid' => $vpcId,
        ));
    }
    
    /**
    * Lists site to site vpn connection gateways
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id id of the vpn connection
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $vpcId id of vpc
    */
    
    public function listVpnConnections($account = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $projectId = "", $vpcId = "") {

        return $this->request("listVpnConnections", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'vpcid' => $vpcId,
        ));
    }
    
    /**
    * Creates a VPC
    *
    * @param string $cidr the cidr of the VPC. All VPC guest networks&#039; cidrs
    *        should be within this CIDR
    * @param string $displayText the display text of the VPC
    * @param string $name the name of the VPC
    * @param string $vpcOfferingId the ID of the VPC offering
    * @param string $zoneId the ID of the availability zone
    * @param string $account the account associated with the VPC. Must be used with
    *        the domainId parameter.
    * @param string $domainId the domain ID associated with the VPC. If used with the
    *        account parameter returns the VPC associated with the account for the specified
    *        domain.
    * @param string $networkDomain VPC network domain. All networks inside the VPC
    *        will belong to this domain
    * @param string $projectId create VPC for the project
    * @param string $start If set to false, the VPC won&#039;t start (VPC VR will not
    *        get allocated) until its first network gets implemented. True by default.
    */
    
    public function createVPC($cidr, $displayText, $name, $vpcOfferingId, $zoneId, $account = "", $domainId = "", $networkDomain = "", $projectId = "", $start = "") {

        if (empty($cidr)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "cidr"), MISSING_ARGUMENT);
        }

        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($vpcOfferingId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vpcOfferingId"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("createVPC", array(
            'cidr' => $cidr,
            'displaytext' => $displayText,
            'name' => $name,
            'vpcofferingid' => $vpcOfferingId,
            'zoneid' => $zoneId,
            'account' => $account,
            'domainid' => $domainId,
            'networkdomain' => $networkDomain,
            'projectid' => $projectId,
            'start' => $start,
        ));
    }
    
    /**
    * Lists VPCs
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $cidr list by cidr of the VPC. All VPC guest networks&#039; cidrs
    *        should be within this CIDR
    * @param string $displayText List by display text of the VPC
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id list VPC by id
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name list by name of the VPC
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $restartRequired list VPCs by restartRequired option
    * @param string $state list VPCs by state
    * @param string $supportedServices list VPC supporting certain services
    * @param string $tags List resources by tags (key/value pairs)
    * @param string $vpcOfferingId list by ID of the VPC offering
    * @param string $zoneId list by zone
    */
    
    public function listVPCs($account = "", $cidr = "", $displayText = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $name = "", $page = "", $pageSize = "", $projectId = "", $restartRequired = "", $state = "", $supportedServices = "", $tags = "", $vpcOfferingId = "", $zoneId = "") {

        return $this->request("listVPCs", array(
            'account' => $account,
            'cidr' => $cidr,
            'displaytext' => $displayText,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'restartrequired' => $restartRequired,
            'state' => $state,
            'supportedservices' => $supportedServices,
            'tags' => $tags,
            'vpcofferingid' => $vpcOfferingId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Deletes a VPC
    *
    * @param string $id the ID of the VPC
    */
    
    public function deleteVPC($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteVPC", array(
            'id' => $id,
        ));
    }
    
    /**
    * Updates a VPC
    *
    * @param string $id the id of the VPC
    * @param string $name the name of the VPC
    * @param string $displayText the display text of the VPC
    */
    
    public function updateVPC($id, $name, $displayText = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        return $this->request("updateVPC", array(
            'id' => $id,
            'name' => $name,
            'displaytext' => $displayText,
        ));
    }
    
    /**
    * Restarts a VPC
    *
    * @param string $id the id of the VPC
    */
    
    public function restartVPC($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("restartVPC", array(
            'id' => $id,
        ));
    }
    
    /**
    * Creates VPC offering
    *
    * @param string $displayText the display text of the vpc offering
    * @param string $name the name of the vpc offering
    * @param string $supportedServices services supported by the vpc offering
    * @param string $serviceOfferingId the ID of the service offering for the VPC
    *        router appliance
    * @param string $serviceProviderList provider to service mapping. If not
    *        specified, the provider for the service will be mapped to the default provider
    *        on the physical network
    */
    
    public function createVPCOffering($displayText, $name, $supportedServices, $serviceOfferingId = "", $serviceProviderList = "") {

        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($supportedServices)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "supportedServices"), MISSING_ARGUMENT);
        }

        return $this->request("createVPCOffering", array(
            'displaytext' => $displayText,
            'name' => $name,
            'supportedservices' => $supportedServices,
            'serviceofferingid' => $serviceOfferingId,
            'serviceproviderlist' => $serviceProviderList,
        ));
    }
    
    /**
    * Updates VPC offering
    *
    * @param string $id the id of the VPC offering
    * @param string $displayText the display text of the VPC offering
    * @param string $name the name of the VPC offering
    * @param string $state update state for the VPC offering; supported states -
    *        Enabled/Disabled
    */
    
    public function updateVPCOffering($id, $displayText = "", $name = "", $state = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateVPCOffering", array(
            'id' => $id,
            'displaytext' => $displayText,
            'name' => $name,
            'state' => $state,
        ));
    }
    
    /**
    * Deletes VPC offering
    *
    * @param string $id the ID of the VPC offering
    */
    
    public function deleteVPCOffering($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteVPCOffering", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists VPC offerings
    *
    * @param string $displayText list VPC offerings by display text
    * @param string $id list VPC offerings by id
    * @param string $isDefault true if need to list only default VPC offerings.
    *        Default value is false
    * @param string $keyword List by keyword
    * @param string $name list VPC offerings by name
    * @param string $page 
    * @param string $pageSize 
    * @param string $state list VPC offerings by state
    * @param string $supportedServices list VPC offerings supporting certain services
    */
    
    public function listVPCOfferings($displayText = "", $id = "", $isDefault = "", $keyword = "", $name = "", $page = "", $pageSize = "", $state = "", $supportedServices = "") {

        return $this->request("listVPCOfferings", array(
            'displaytext' => $displayText,
            'id' => $id,
            'isdefault' => $isDefault,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'state' => $state,
            'supportedservices' => $supportedServices,
        ));
    }
    
    /**
    * Creates a private gateway
    *
    * @param string $gateway the gateway of the Private gateway
    * @param string $ipAddress the IP address of the Private gateaway
    * @param string $netmask the netmask of the Private gateway
    * @param string $vlan the network implementation uri for the private gateway
    * @param string $vpcId the VPC network belongs to
    * @param string $aclId the ID of the network ACL
    * @param string $networkOfferingId the uuid of the network offering to use for the
    *        private gateways network connection
    * @param string $physicalNetworkId the Physical Network ID the network belongs to
    * @param string $sourceNatSupported source NAT supported value. Default value
    *        false. If &#039;true&#039; source NAT is enabled on the private gateway
    *        &#039;false&#039;: sourcenat is not supported
    */
    
    public function createPrivateGateway($gateway, $ipAddress, $netmask, $vlan, $vpcId, $aclId = "", $networkOfferingId = "", $physicalNetworkId = "", $sourceNatSupported = "") {

        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gateway"), MISSING_ARGUMENT);
        }

        if (empty($ipAddress)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipAddress"), MISSING_ARGUMENT);
        }

        if (empty($netmask)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "netmask"), MISSING_ARGUMENT);
        }

        if (empty($vlan)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vlan"), MISSING_ARGUMENT);
        }

        if (empty($vpcId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vpcId"), MISSING_ARGUMENT);
        }

        return $this->request("createPrivateGateway", array(
            'gateway' => $gateway,
            'ipaddress' => $ipAddress,
            'netmask' => $netmask,
            'vlan' => $vlan,
            'vpcid' => $vpcId,
            'aclid' => $aclId,
            'networkofferingid' => $networkOfferingId,
            'physicalnetworkid' => $physicalNetworkId,
            'sourcenatsupported' => $sourceNatSupported,
        ));
    }
    
    /**
    * List private gateways
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id list private gateway by id
    * @param string $ipAddress list gateways by ip address
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $state list gateways by state
    * @param string $vlan list gateways by vlan
    * @param string $vpcId list gateways by vpc
    */
    
    public function listPrivateGateways($account = "", $domainId = "", $id = "", $ipAddress = "", $isRecursive = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $projectId = "", $state = "", $vlan = "", $vpcId = "") {

        return $this->request("listPrivateGateways", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'ipaddress' => $ipAddress,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'state' => $state,
            'vlan' => $vlan,
            'vpcid' => $vpcId,
        ));
    }
    
    /**
    * Deletes a Private gateway
    *
    * @param string $id the ID of the private gateway
    */
    
    public function deletePrivateGateway($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deletePrivateGateway", array(
            'id' => $id,
        ));
    }
    
    /**
    * Creates a static route
    *
    * @param string $cidr static route cidr
    * @param string $gatewayId the gateway id we are creating static route for
    */
    
    public function createStaticRoute($cidr, $gatewayId) {

        if (empty($cidr)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "cidr"), MISSING_ARGUMENT);
        }

        if (empty($gatewayId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gatewayId"), MISSING_ARGUMENT);
        }

        return $this->request("createStaticRoute", array(
            'cidr' => $cidr,
            'gatewayid' => $gatewayId,
        ));
    }
    
    /**
    * Deletes a static route
    *
    * @param string $id the ID of the static route
    */
    
    public function deleteStaticRoute($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteStaticRoute", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists all static routes
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $gatewayId list static routes by gateway id
    * @param string $id list static route by id
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $tags List resources by tags (key/value pairs)
    * @param string $vpcId list static routes by vpc id
    */
    
    public function listStaticRoutes($account = "", $domainId = "", $gatewayId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $projectId = "", $tags = "", $vpcId = "") {

        return $this->request("listStaticRoutes", array(
            'account' => $account,
            'domainid' => $domainId,
            'gatewayid' => $gatewayId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'tags' => $tags,
            'vpcid' => $vpcId,
        ));
    }
    
    /**
    * Adds a new host.
    *
    * @param string $hypervisor hypervisor type of the host
    * @param string $password the password for the host
    * @param string $podId the Pod ID for the host
    * @param string $url the host URL
    * @param string $userName the username for the host
    * @param string $zoneId the Zone ID for the host
    * @param string $allocationState Allocation state of this Host for allocation of
    *        new resources
    * @param string $clusterId the cluster ID for the host
    * @param string $clusterName the cluster name for the host
    * @param string $hosttags list of tags to be added to the host
    */
    
    public function addHost($hypervisor, $password, $podId, $url, $userName, $zoneId, $allocationState = "", $clusterId = "", $clusterName = "", $hosttags = "") {

        if (empty($hypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hypervisor"), MISSING_ARGUMENT);
        }

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($podId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "podId"), MISSING_ARGUMENT);
        }

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("addHost", array(
            'hypervisor' => $hypervisor,
            'password' => $password,
            'podid' => $podId,
            'url' => $url,
            'username' => $userName,
            'zoneid' => $zoneId,
            'allocationstate' => $allocationState,
            'clusterid' => $clusterId,
            'clustername' => $clusterName,
            'hosttags' => $hosttags,
        ));
    }
    
    /**
    * Reconnects a host.
    *
    * @param string $id the host ID
    */
    
    public function reconnectHost($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("reconnectHost", array(
            'id' => $id,
        ));
    }
    
    /**
    * Updates a host.
    *
    * @param string $id the ID of the host to update
    * @param string $allocationState Change resource state of host, valid values are
    *        [Enable, Disable]. Operation may failed if host in states not allowing
    *        Enable/Disable
    * @param string $hosttags list of tags to be added to the host
    * @param string $osCategoryId the id of Os category to update the host with
    * @param string $url the new uri for the secondary storage: nfs://host/path
    */
    
    public function updateHost($id, $allocationState = "", $hosttags = "", $osCategoryId = "", $url = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateHost", array(
            'id' => $id,
            'allocationstate' => $allocationState,
            'hosttags' => $hosttags,
            'oscategoryid' => $osCategoryId,
            'url' => $url,
        ));
    }
    
    /**
    * Deletes a host.
    *
    * @param string $id the host ID
    * @param string $forced Force delete the host. All HA enabled vms running on the
    *        host will be put to HA; HA disabled ones will be stopped
    * @param string $forceDestroyLocalStorage Force destroy local storage on this
    *        host. All VMs created on this local storage will be destroyed
    */
    
    public function deleteHost($id, $forced = "", $forceDestroyLocalStorage = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteHost", array(
            'id' => $id,
            'forced' => $forced,
            'forcedestroylocalstorage' => $forceDestroyLocalStorage,
        ));
    }
    
    /**
    * Prepares a host for maintenance.
    *
    * @param string $id the host ID
    */
    
    public function prepareHostForMaintenance($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("prepareHostForMaintenance", array(
            'id' => $id,
        ));
    }
    
    /**
    * Cancels host maintenance.
    *
    * @param string $id the host ID
    */
    
    public function cancelHostMaintenance($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("cancelHostMaintenance", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists hosts.
    *
    * @param string $clusterId lists hosts existing in particular cluster
    * @param string $details comma separated list of host details requested, value can
    *        be a list of [ min, all, capacity, events, stats]
    * @param string $haHost if true, list only hosts dedicated to HA
    * @param string $hypervisor hypervisor type of host:
    *        XenServer,KVM,VMware,Hyperv,BareMetal,Simulator
    * @param string $id the id of the host
    * @param string $keyword List by keyword
    * @param string $name the name of the host
    * @param string $page 
    * @param string $pageSize 
    * @param string $podId the Pod ID for the host
    * @param string $resourcestate list hosts by resource state. Resource state
    *        represents current state determined by admin of host, valule can be one of
    *        [Enabled, Disabled, Unmanaged, PrepareForMaintenance, ErrorInMaintenance,
    *        Maintenance, Error]
    * @param string $state the state of the host
    * @param string $type the host type
    * @param string $virtualMachineId lists hosts in the same cluster as this VM and
    *        flag hosts with enough CPU/RAm to host this VM
    * @param string $zoneId the Zone ID for the host
    */
    
    public function listHosts($clusterId = "", $details = "", $haHost = "", $hypervisor = "", $id = "", $keyword = "", $name = "", $page = "", $pageSize = "", $podId = "", $resourcestate = "", $state = "", $type = "", $virtualMachineId = "", $zoneId = "") {

        return $this->request("listHosts", array(
            'clusterid' => $clusterId,
            'details' => $details,
            'hahost' => $haHost,
            'hypervisor' => $hypervisor,
            'id' => $id,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'podid' => $podId,
            'resourcestate' => $resourcestate,
            'state' => $state,
            'type' => $type,
            'virtualmachineid' => $virtualMachineId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Find hosts suitable for migrating a virtual machine.
    *
    * @param string $virtualMachineId find hosts to which this VM can be migrated and
    *        flag the hosts with enough CPU/RAM to host the VM
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function findHostsForMigration($virtualMachineId, $keyword = "", $page = "", $pageSize = "") {

        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }

        return $this->request("findHostsForMigration", array(
            'virtualmachineid' => $virtualMachineId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Adds secondary storage.
    *
    * @param string $url the URL for the secondary storage
    * @param string $zoneId the Zone ID for the secondary storage
    */
    
    public function addSecondaryStorage($url, $zoneId = "") {

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        return $this->request("addSecondaryStorage", array(
            'url' => $url,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Update password of a host/pool on management server.
    *
    * @param string $password the new password for the host/cluster
    * @param string $userName the username for the host/cluster
    * @param string $clusterId the cluster ID
    * @param string $hostId the host ID
    */
    
    public function updateHostPassword($password, $userName, $clusterId = "", $hostId = "") {

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        return $this->request("updateHostPassword", array(
            'password' => $password,
            'username' => $userName,
            'clusterid' => $clusterId,
            'hostid' => $hostId,
        ));
    }
    
    /**
    * Releases host reservation.
    *
    * @param string $id the host ID
    */
    
    public function releaseHostReservation($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("releaseHostReservation", array(
            'id' => $id,
        ));
    }
    
    /**
    * add a baremetal host
    *
    * @param string $hypervisor hypervisor type of the host
    * @param string $password the password for the host
    * @param string $podId the Pod ID for the host
    * @param string $url the host URL
    * @param string $userName the username for the host
    * @param string $zoneId the Zone ID for the host
    * @param string $allocationState Allocation state of this Host for allocation of
    *        new resources
    * @param string $clusterId the cluster ID for the host
    * @param string $clusterName the cluster name for the host
    * @param string $hosttags list of tags to be added to the host
    * @param string $ipAddress ip address intentionally allocated to this host after
    *        provisioning
    */
    
    public function addBaremetalHost($hypervisor, $password, $podId, $url, $userName, $zoneId, $allocationState = "", $clusterId = "", $clusterName = "", $hosttags = "", $ipAddress = "") {

        if (empty($hypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hypervisor"), MISSING_ARGUMENT);
        }

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($podId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "podId"), MISSING_ARGUMENT);
        }

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("addBaremetalHost", array(
            'hypervisor' => $hypervisor,
            'password' => $password,
            'podid' => $podId,
            'url' => $url,
            'username' => $userName,
            'zoneid' => $zoneId,
            'allocationstate' => $allocationState,
            'clusterid' => $clusterId,
            'clustername' => $clusterName,
            'hosttags' => $hosttags,
            'ipaddress' => $ipAddress,
        ));
    }
    
    /**
    * Dedicates a host.
    *
    * @param string $domainId the ID of the containing domain
    * @param string $hostId the ID of the host to update
    * @param string $account the name of the account which needs dedication. Must be
    *        used with domainId.
    */
    
    public function dedicateHost($domainId, $hostId, $account = "") {

        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }

        if (empty($hostId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostId"), MISSING_ARGUMENT);
        }

        return $this->request("dedicateHost", array(
            'domainid' => $domainId,
            'hostid' => $hostId,
            'account' => $account,
        ));
    }
    
    /**
    * Release the dedication for host
    *
    * @param string $hostId the ID of the host
    */
    
    public function releaseDedicatedHost($hostId) {

        if (empty($hostId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostId"), MISSING_ARGUMENT);
        }

        return $this->request("releaseDedicatedHost", array(
            'hostid' => $hostId,
        ));
    }
    
    /**
    * Lists dedicated hosts.
    *
    * @param string $account the name of the account associated with the host. Must be
    *        used with domainId.
    * @param string $affinityGroupId list dedicated hosts by affinity group
    * @param string $domainId the ID of the domain associated with the host
    * @param string $hostId the ID of the host
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listDedicatedHosts($account = "", $affinityGroupId = "", $domainId = "", $hostId = "", $keyword = "", $page = "", $pageSize = "") {

        return $this->request("listDedicatedHosts", array(
            'account' => $account,
            'affinitygroupid' => $affinityGroupId,
            'domainid' => $domainId,
            'hostid' => $hostId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Attaches a disk volume to a virtual machine.
    *
    * @param string $id the ID of the disk volume
    * @param string $virtualMachineId the ID of the virtual machine
    * @param string $deviceId the ID of the device to map the volume to within the
    *        guest OS. If no deviceId is passed in, the next available deviceId will be
    *        chosen. Possible values for a Linux OS are:* 1 - /dev/xvdb* 2 - /dev/xvdc* 4 -
    *        /dev/xvde* 5 - /dev/xvdf* 6 - /dev/xvdg* 7 - /dev/xvdh* 8 - /dev/xvdi* 9 -
    *        /dev/xvdj
    */
    
    public function attachVolume($id, $virtualMachineId, $deviceId = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }

        return $this->request("attachVolume", array(
            'id' => $id,
            'virtualmachineid' => $virtualMachineId,
            'deviceid' => $deviceId,
        ));
    }
    
    /**
    * Uploads a data disk.
    *
    * @param string $format the format for the volume. Possible values include QCOW2,
    *        OVA, and VHD.
    * @param string $name the name of the volume
    * @param string $url the URL of where the volume is hosted. Possible URL include
    *        http:// and https://
    * @param string $zoneId the ID of the zone the volume is to be hosted on
    * @param string $account an optional accountName. Must be used with domainId.
    * @param string $checksum the MD5 checksum value of this volume
    * @param string $domainId an optional domainId. If the account parameter is used,
    *        domainId must also be used.
    * @param string $imageStoreUuid Image store uuid
    * @param string $projectId Upload volume for the project
    */
    
    public function uploadVolume($format, $name, $url, $zoneId, $account = "", $checksum = "", $domainId = "", $imageStoreUuid = "", $projectId = "") {

        if (empty($format)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "format"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("uploadVolume", array(
            'format' => $format,
            'name' => $name,
            'url' => $url,
            'zoneid' => $zoneId,
            'account' => $account,
            'checksum' => $checksum,
            'domainid' => $domainId,
            'imagestoreuuid' => $imageStoreUuid,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * Detaches a disk volume from a virtual machine.
    *
    * @param string $deviceId the device ID on the virtual machine where volume is
    *        detached from
    * @param string $id the ID of the disk volume
    * @param string $virtualMachineId the ID of the virtual machine where the volume
    *        is detached from
    */
    
    public function detachVolume($deviceId = "", $id = "", $virtualMachineId = "") {

        return $this->request("detachVolume", array(
            'deviceid' => $deviceId,
            'id' => $id,
            'virtualmachineid' => $virtualMachineId,
        ));
    }
    
    /**
    * Creates a disk volume from a disk offering. This disk volume must still be attached to a virtual machine to make use of it.
    *
    * @param string $name the name of the disk volume
    * @param string $account the account associated with the disk volume. Must be used
    *        with the domainId parameter.
    * @param string $diskOfferingId the ID of the disk offering. Either diskOfferingId
    *        or snapshotId must be passed in.
    * @param string $displayVolume an optional field, whether to display the volume to
    *        the end user or not.
    * @param string $domainId the domain ID associated with the disk offering. If used
    *        with the account parameter returns the disk volume associated with the account
    *        for the specified domain.
    * @param string $maxIops max iops
    * @param string $minIops min iops
    * @param string $projectId the project associated with the volume. Mutually
    *        exclusive with account parameter
    * @param string $size Arbitrary volume size
    * @param string $snapshotId the snapshot ID for the disk volume. Either
    *        diskOfferingId or snapshotId must be passed in.
    * @param string $virtualMachineId the ID of the virtual machine; to be used with
    *        snapshot Id, VM to which the volume gets attached after creation
    * @param string $zoneId the ID of the availability zone
    */
    
    public function createVolume($name, $account = "", $diskOfferingId = "", $displayVolume = "", $domainId = "", $maxIops = "", $minIops = "", $projectId = "", $size = "", $snapshotId = "", $virtualMachineId = "", $zoneId = "") {

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        return $this->request("createVolume", array(
            'name' => $name,
            'account' => $account,
            'diskofferingid' => $diskOfferingId,
            'displayvolume' => $displayVolume,
            'domainid' => $domainId,
            'maxiops' => $maxIops,
            'miniops' => $minIops,
            'projectid' => $projectId,
            'size' => $size,
            'snapshotid' => $snapshotId,
            'virtualmachineid' => $virtualMachineId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Deletes a detached disk volume.
    *
    * @param string $id The ID of the disk volume
    */
    
    public function deleteVolume($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteVolume", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists all volumes.
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $hostId list volumes on specified host
    * @param string $id the ID of the disk volume
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name the name of the disk volume
    * @param string $page 
    * @param string $pageSize 
    * @param string $podId the pod id the disk volume belongs to
    * @param string $projectId list objects by project
    * @param string $storageId the ID of the storage pool, available to ROOT admin
    *        only
    * @param string $tags List resources by tags (key/value pairs)
    * @param string $type the type of disk volume
    * @param string $virtualMachineId the ID of the virtual machine
    * @param string $zoneId the ID of the availability zone
    */
    
    public function listVolumes($account = "", $domainId = "", $hostId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $name = "", $page = "", $pageSize = "", $podId = "", $projectId = "", $storageId = "", $tags = "", $type = "", $virtualMachineId = "", $zoneId = "") {

        return $this->request("listVolumes", array(
            'account' => $account,
            'domainid' => $domainId,
            'hostid' => $hostId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'podid' => $podId,
            'projectid' => $projectId,
            'storageid' => $storageId,
            'tags' => $tags,
            'type' => $type,
            'virtualmachineid' => $virtualMachineId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Extracts volume
    *
    * @param string $id the ID of the volume
    * @param string $mode the mode of extraction - HTTP_DOWNLOAD or FTP_UPLOAD
    * @param string $zoneId the ID of the zone where the volume is located
    * @param string $url the url to which the volume would be extracted
    */
    
    public function extractVolume($id, $mode, $zoneId, $url = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($mode)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "mode"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("extractVolume", array(
            'id' => $id,
            'mode' => $mode,
            'zoneid' => $zoneId,
            'url' => $url,
        ));
    }
    
    /**
    * Migrate volume
    *
    * @param string $storageId destination storage pool ID to migrate the volume to
    * @param string $volumeId the ID of the volume
    * @param string $liveMigrate if the volume should be live migrated when it is
    *        attached to a running vm
    */
    
    public function migrateVolume($storageId, $volumeId, $liveMigrate = "") {

        if (empty($storageId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "storageId"), MISSING_ARGUMENT);
        }

        if (empty($volumeId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "volumeId"), MISSING_ARGUMENT);
        }

        return $this->request("migrateVolume", array(
            'storageid' => $storageId,
            'volumeid' => $volumeId,
            'livemigrate' => $liveMigrate,
        ));
    }
    
    /**
    * Resizes a volume
    *
    * @param string $diskOfferingId new disk offering id
    * @param string $id the ID of the disk volume
    * @param string $shrinkOk Verify OK to Shrink
    * @param string $size New volume size in G
    */
    
    public function resizeVolume($diskOfferingId = "", $id = "", $shrinkOk = "", $size = "") {

        return $this->request("resizeVolume", array(
            'diskofferingid' => $diskOfferingId,
            'id' => $id,
            'shrinkok' => $shrinkOk,
            'size' => $size,
        ));
    }
    
    /**
    * Updates the volume.
    *
    * @param string $displayVolume an optional field, whether to the display the
    *        volume to the end user or not.
    * @param string $id the ID of the disk volume
    * @param string $path The path of the volume
    * @param string $state The state of the volume
    * @param string $storageId Destination storage pool UUID for the volume
    */
    
    public function updateVolume($displayVolume = "", $id = "", $path = "", $state = "", $storageId = "") {

        return $this->request("updateVolume", array(
            'displayvolume' => $displayVolume,
            'id' => $id,
            'path' => $path,
            'state' => $state,
            'storageid' => $storageId,
        ));
    }
    
    /**
    * Create a volume
    *
    * @param string $aggregateName aggregate name.
    * @param string $ipAddress ip address.
    * @param string $password password.
    * @param string $poolName pool name.
    * @param string $size volume size.
    * @param string $userName user name.
    * @param string $volumeName volume name.
    * @param string $snapshotPolicy snapshot policy.
    * @param string $snapshotReservation snapshot reservation.
    */
    
    public function createVolumeOnFiler($aggregateName, $ipAddress, $password, $poolName, $size, $userName, $volumeName, $snapshotPolicy = "", $snapshotReservation = "") {

        if (empty($aggregateName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "aggregateName"), MISSING_ARGUMENT);
        }

        if (empty($ipAddress)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipAddress"), MISSING_ARGUMENT);
        }

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($poolName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "poolName"), MISSING_ARGUMENT);
        }

        if (empty($size)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "size"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        if (empty($volumeName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "volumeName"), MISSING_ARGUMENT);
        }

        return $this->request("createVolumeOnFiler", array(
            'aggregatename' => $aggregateName,
            'ipaddress' => $ipAddress,
            'password' => $password,
            'poolname' => $poolName,
            'size' => $size,
            'username' => $userName,
            'volumename' => $volumeName,
            'snapshotpolicy' => $snapshotPolicy,
            'snapshotreservation' => $snapshotReservation,
        ));
    }
    
    /**
    * Destroy a Volume
    *
    * @param string $aggregateName aggregate name.
    * @param string $ipAddress ip address.
    * @param string $volumeName volume name.
    */
    
    public function destroyVolumeOnFiler($aggregateName, $ipAddress, $volumeName) {

        if (empty($aggregateName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "aggregateName"), MISSING_ARGUMENT);
        }

        if (empty($ipAddress)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipAddress"), MISSING_ARGUMENT);
        }

        if (empty($volumeName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "volumeName"), MISSING_ARGUMENT);
        }

        return $this->request("destroyVolumeOnFiler", array(
            'aggregatename' => $aggregateName,
            'ipaddress' => $ipAddress,
            'volumename' => $volumeName,
        ));
    }
    
    /**
    * List Volumes
    *
    * @param string $poolName pool name.
    */
    
    public function listVolumesOnFiler($poolName) {

        if (empty($poolName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "poolName"), MISSING_ARGUMENT);
        }

        return $this->request("listVolumesOnFiler", array(
            'poolname' => $poolName,
        ));
    }
    
    /**
    * Creates a template of a virtual machine. The virtual machine must be in a STOPPED state. A template created from this command is automatically designated as a private template visible to the account that created it.
    *
    * @param string $displayText the display text of the template. This is usually
    *        used for display purposes.
    * @param string $name the name of the template
    * @param string $osTypeId the ID of the OS Type that best represents the OS of
    *        this template.
    * @param string $bits 32 or 64 bit
    * @param string $details Template details in key/value pairs.
    * @param string $isDynamicallyScalable true if template contains XS/VMWare tools
    *        inorder to support dynamic scaling of VM cpu/memory
    * @param string $isFeatured true if this template is a featured template, false
    *        otherwise
    * @param string $isPublic true if this template is a public template, false
    *        otherwise
    * @param string $passwordEnabled true if the template supports the password reset
    *        feature; default is false
    * @param string $requireShvm true if the template requres HVM, false otherwise
    * @param string $snapshotId the ID of the snapshot the template is being created
    *        from. Either this parameter, or volumeId has to be passed in
    * @param string $templateTag the tag for this template.
    * @param string $url Optional, only for baremetal hypervisor. The directory name
    *        where template stored on CIFS server
    * @param string $virtualMachineId Optional, VM ID. If this presents, it is going
    *        to create a baremetal template for VM this ID refers to. This is only for VM
    *        whose hypervisor type is BareMetal
    * @param string $volumeId the ID of the disk volume the template is being created
    *        from. Either this parameter, or snapshotId has to be passed in
    */
    
    public function createTemplate($displayText, $name, $osTypeId, $bits = "", $details = "", $isDynamicallyScalable = "", $isFeatured = "", $isPublic = "", $passwordEnabled = "", $requireShvm = "", $snapshotId = "", $templateTag = "", $url = "", $virtualMachineId = "", $volumeId = "") {

        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($osTypeId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "osTypeId"), MISSING_ARGUMENT);
        }

        return $this->request("createTemplate", array(
            'displaytext' => $displayText,
            'name' => $name,
            'ostypeid' => $osTypeId,
            'bits' => $bits,
            'details' => $details,
            'isdynamicallyscalable' => $isDynamicallyScalable,
            'isfeatured' => $isFeatured,
            'ispublic' => $isPublic,
            'passwordenabled' => $passwordEnabled,
            'requireshvm' => $requireShvm,
            'snapshotid' => $snapshotId,
            'templatetag' => $templateTag,
            'url' => $url,
            'virtualmachineid' => $virtualMachineId,
            'volumeid' => $volumeId,
        ));
    }
    
    /**
    * Registers an existing template into the CloudStack cloud.
    *
    * @param string $displayText the display text of the template. This is usually
    *        used for display purposes.
    * @param string $format the format for the template. Possible values include
    *        QCOW2, RAW, and VHD.
    * @param string $hypervisor the target hypervisor for the template
    * @param string $name the name of the template
    * @param string $osTypeId the ID of the OS Type that best represents the OS of
    *        this template.
    * @param string $url the URL of where the template is hosted. Possible URL include
    *        http:// and https://
    * @param string $zoneId the ID of the zone the template is to be hosted on
    * @param string $account an optional accountName. Must be used with domainId.
    * @param string $bits 32 or 64 bits support. 64 by default
    * @param string $checksum the MD5 checksum value of this template
    * @param string $details Template details in key/value pairs.
    * @param string $domainId an optional domainId. If the account parameter is used,
    *        domainId must also be used.
    * @param string $isDynamicallyScalable true if template contains XS/VMWare tools
    *        inorder to support dynamic scaling of VM cpu/memory
    * @param string $isExtractable true if the template or its derivatives are
    *        extractable; default is false
    * @param string $isFeatured true if this template is a featured template, false
    *        otherwise
    * @param string $isPublic true if the template is available to all accounts;
    *        default is true
    * @param string $isRouting true if the template type is routing i.e., if template
    *        is used to deploy router
    * @param string $passwordEnabled true if the template supports the password reset
    *        feature; default is false
    * @param string $projectId Register template for the project
    * @param string $requireShvm true if this template requires HVM
    * @param string $sshkeyEnabled true if the template supports the sshkey upload
    *        feature; default is false
    * @param string $templateTag the tag for this template.
    */
    
    public function registerTemplate($displayText, $format, $hypervisor, $name, $osTypeId, $url, $zoneId, $account = "", $bits = "", $checksum = "", $details = "", $domainId = "", $isDynamicallyScalable = "", $isExtractable = "", $isFeatured = "", $isPublic = "", $isRouting = "", $passwordEnabled = "", $projectId = "", $requireShvm = "", $sshkeyEnabled = "", $templateTag = "") {

        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }

        if (empty($format)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "format"), MISSING_ARGUMENT);
        }

        if (empty($hypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hypervisor"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($osTypeId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "osTypeId"), MISSING_ARGUMENT);
        }

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("registerTemplate", array(
            'displaytext' => $displayText,
            'format' => $format,
            'hypervisor' => $hypervisor,
            'name' => $name,
            'ostypeid' => $osTypeId,
            'url' => $url,
            'zoneid' => $zoneId,
            'account' => $account,
            'bits' => $bits,
            'checksum' => $checksum,
            'details' => $details,
            'domainid' => $domainId,
            'isdynamicallyscalable' => $isDynamicallyScalable,
            'isextractable' => $isExtractable,
            'isfeatured' => $isFeatured,
            'ispublic' => $isPublic,
            'isrouting' => $isRouting,
            'passwordenabled' => $passwordEnabled,
            'projectid' => $projectId,
            'requireshvm' => $requireShvm,
            'sshkeyenabled' => $sshkeyEnabled,
            'templatetag' => $templateTag,
        ));
    }
    
    /**
    * Updates attributes of a template.
    *
    * @param string $id the ID of the image file
    * @param string $bootable true if image is bootable, false otherwise
    * @param string $displayText the display text of the image
    * @param string $format the format for the image
    * @param string $isDynamicallyScalable true if template/ISO contains XS/VMWare
    *        tools inorder to support dynamic scaling of VM cpu/memory
    * @param string $isRouting true if the template type is routing i.e., if template
    *        is used to deploy router
    * @param string $name the name of the image file
    * @param string $osTypeId the ID of the OS type that best represents the OS of
    *        this image.
    * @param string $passwordEnabled true if the image supports the password reset
    *        feature; default is false
    * @param string $sortKey sort key of the template, integer
    */
    
    public function updateTemplate($id, $bootable = "", $displayText = "", $format = "", $isDynamicallyScalable = "", $isRouting = "", $name = "", $osTypeId = "", $passwordEnabled = "", $sortKey = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateTemplate", array(
            'id' => $id,
            'bootable' => $bootable,
            'displaytext' => $displayText,
            'format' => $format,
            'isdynamicallyscalable' => $isDynamicallyScalable,
            'isrouting' => $isRouting,
            'name' => $name,
            'ostypeid' => $osTypeId,
            'passwordenabled' => $passwordEnabled,
            'sortkey' => $sortKey,
        ));
    }
    
    /**
    * Copies a template from one zone to another.
    *
    * @param string $id Template ID.
    * @param string $destzoneId ID of the zone the template is being copied to.
    * @param string $sourceZoneId ID of the zone the template is currently hosted on.
    *        If not specified and template is cross-zone, then we will sync this template to
    *        region wide image store
    */
    
    public function copyTemplate($id, $destzoneId, $sourceZoneId = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($destzoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "destzoneId"), MISSING_ARGUMENT);
        }

        return $this->request("copyTemplate", array(
            'id' => $id,
            'destzoneid' => $destzoneId,
            'sourcezoneid' => $sourceZoneId,
        ));
    }
    
    /**
    * Deletes a template from the system. All virtual machines using the deleted template will not be affected.
    *
    * @param string $id the ID of the template
    * @param string $zoneId the ID of zone of the template
    */
    
    public function deleteTemplate($id, $zoneId = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteTemplate", array(
            'id' => $id,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * List all public, private, and privileged templates.
    *
    * @param string $templateFilter possible values are &quot;featured&quot;,
    *        &quot;self&quot;,
    *        &quot;selfexecutable&quot;,&quot;sharedexecutable&quot;,&quot;executable&quot;,
    *        and &quot;community&quot;. * featured : templates that have been marked as
    *        featured and public. * self : templates that have been registered or created by
    *        the calling user. * selfexecutable : same as self, but only returns templates
    *        that can be used to deploy a new VM. * sharedexecutable : templates ready to be
    *        deployed that have been granted to the calling user by another user. *
    *        executable : templates that are owned by the calling user, or public templates,
    *        that can be used to deploy a VM. * community : templates that have been marked
    *        as public but not featured. * all : all templates (only usable by admins).
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $hypervisor the hypervisor for which to restrict the search
    * @param string $id the template ID
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name the template name
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $showRemoved show removed templates as well
    * @param string $tags List resources by tags (key/value pairs)
    * @param string $zoneId list templates by zoneId
    */
    
    public function listTemplates($templateFilter, $account = "", $domainId = "", $hypervisor = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $name = "", $page = "", $pageSize = "", $projectId = "", $showRemoved = "", $tags = "", $zoneId = "") {

        if (empty($templateFilter)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "templateFilter"), MISSING_ARGUMENT);
        }

        return $this->request("listTemplates", array(
            'templatefilter' => $templateFilter,
            'account' => $account,
            'domainid' => $domainId,
            'hypervisor' => $hypervisor,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'showremoved' => $showRemoved,
            'tags' => $tags,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Updates a template visibility permissions. A public template is visible to all accounts within the same domain. A private template is visible only to the owner of the template. A priviledged template is a private template with account permissions added. Only accounts specified under the template permissions are visible to them.
    *
    * @param string $id the template ID
    * @param string $accounts a comma delimited list of accounts. If specified,
    *        &quot;op&quot; parameter has to be passed in.
    * @param string $isExtractable true if the template/iso is extractable, false
    *        other wise. Can be set only by root admin
    * @param string $isFeatured true for featured template/iso, false otherwise
    * @param string $isPublic true for public template/iso, false for private
    *        templates/isos
    * @param string $op permission operator (add, remove, reset)
    * @param string $projectids a comma delimited list of projects. If specified,
    *        &quot;op&quot; parameter has to be passed in.
    */
    
    public function updateTemplatePermissions($id, $accounts = "", $isExtractable = "", $isFeatured = "", $isPublic = "", $op = "", $projectids = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateTemplatePermissions", array(
            'id' => $id,
            'accounts' => $accounts,
            'isextractable' => $isExtractable,
            'isfeatured' => $isFeatured,
            'ispublic' => $isPublic,
            'op' => $op,
            'projectids' => $projectids,
        ));
    }
    
    /**
    * List template visibility and all accounts that have permissions to view this template.
    *
    * @param string $id the template ID
    */
    
    public function listTemplatePermissions($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("listTemplatePermissions", array(
            'id' => $id,
        ));
    }
    
    /**
    * Extracts a template
    *
    * @param string $id the ID of the template
    * @param string $mode the mode of extraction - HTTP_DOWNLOAD or FTP_UPLOAD
    * @param string $url the url to which the ISO would be extracted
    * @param string $zoneId the ID of the zone where the ISO is originally located
    */
    
    public function extractTemplate($id, $mode, $url = "", $zoneId = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($mode)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "mode"), MISSING_ARGUMENT);
        }

        return $this->request("extractTemplate", array(
            'id' => $id,
            'mode' => $mode,
            'url' => $url,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * load template into primary storage
    *
    * @param string $templateId template ID of the template to be prepared in primary
    *        storage(s).
    * @param string $zoneId zone ID of the template to be prepared in primary
    *        storage(s).
    */
    
    public function prepareTemplate($templateId, $zoneId) {

        if (empty($templateId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "templateId"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("prepareTemplate", array(
            'templateid' => $templateId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Upgrades router to use newer template
    *
    * @param string $account upgrades all routers owned by the specified account
    * @param string $clusterId upgrades all routers within the specified cluster
    * @param string $domainId upgrades all routers owned by the specified domain
    * @param string $id upgrades router with the specified Id
    * @param string $podId upgrades all routers within the specified pod
    * @param string $zoneId upgrades all routers within the specified zone
    */
    
    public function upgradeRouterTemplate($account = "", $clusterId = "", $domainId = "", $id = "", $podId = "", $zoneId = "") {

        return $this->request("upgradeRouterTemplate", array(
            'account' => $account,
            'clusterid' => $clusterId,
            'domainid' => $domainId,
            'id' => $id,
            'podid' => $podId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * List templates in ucs manager
    *
    * @param string $ucsManagerId the id for the ucs manager
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listUcsTemplates($ucsManagerId, $keyword = "", $page = "", $pageSize = "") {

        if (empty($ucsManagerId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsManagerId"), MISSING_ARGUMENT);
        }

        return $this->request("listUcsTemplates", array(
            'ucsmanagerid' => $ucsManagerId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * create a profile of template and associate to a blade
    *
    * @param string $bladeId blade id
    * @param string $templateDn template dn
    * @param string $ucsManagerId ucs manager id
    * @param string $profileName profile name
    */
    
    public function instantiateUcsTemplateAndAssocaciateToBlade($bladeId, $templateDn, $ucsManagerId, $profileName = "") {

        if (empty($bladeId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "bladeId"), MISSING_ARGUMENT);
        }

        if (empty($templateDn)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "templateDn"), MISSING_ARGUMENT);
        }

        if (empty($ucsManagerId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsManagerId"), MISSING_ARGUMENT);
        }

        return $this->request("instantiateUcsTemplateAndAssocaciateToBlade", array(
            'bladeid' => $bladeId,
            'templatedn' => $templateDn,
            'ucsmanagerid' => $ucsManagerId,
            'profilename' => $profileName,
        ));
    }
    
    /**
    * Creates a user for an account that already exists
    *
    * @param string $account Creates the user under the specified account. If no
    *        account is specified, the username will be used as the account name.
    * @param string $email email
    * @param string $firstName firstname
    * @param string $lastname lastname
    * @param string $password Clear text password (Default hashed to SHA256SALT). If
    *        you wish to use any other hashing algorithm, you would need to write a custom
    *        authentication adapter See Docs section.
    * @param string $userName Unique username.
    * @param string $domainId Creates the user under the specified domain. Has to be
    *        accompanied with the account parameter
    * @param string $timezone Specifies a timezone for this command. For more
    *        information on the timezone parameter, see Time Zone Format.
    * @param string $userId User UUID, required for adding account from external
    *        provisioning system
    */
    
    public function createUser($account, $email, $firstName, $lastname, $password, $userName, $domainId = "", $timezone = "", $userId = "") {

        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }

        if (empty($email)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "email"), MISSING_ARGUMENT);
        }

        if (empty($firstName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "firstName"), MISSING_ARGUMENT);
        }

        if (empty($lastname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lastname"), MISSING_ARGUMENT);
        }

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        return $this->request("createUser", array(
            'account' => $account,
            'email' => $email,
            'firstname' => $firstName,
            'lastname' => $lastname,
            'password' => $password,
            'username' => $userName,
            'domainid' => $domainId,
            'timezone' => $timezone,
            'userid' => $userId,
        ));
    }
    
    /**
    * Deletes a user for an account
    *
    * @param string $id id of the user to be deleted
    */
    
    public function deleteUser($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteUser", array(
            'id' => $id,
        ));
    }
    
    /**
    * Updates a user account
    *
    * @param string $id User uuid
    * @param string $email email
    * @param string $firstName first name
    * @param string $lastname last name
    * @param string $password Clear text password (default hashed to SHA256SALT). If
    *        you wish to use any other hasing algorithm, you would need to write a custom
    *        authentication adapter
    * @param string $timezone Specifies a timezone for this command. For more
    *        information on the timezone parameter, see Time Zone Format.
    * @param string $userApiKey The API key for the user. Must be specified with
    *        userSecretKey
    * @param string $userName Unique username
    * @param string $userSecretKey The secret key for the user. Must be specified with
    *        userApiKey
    */
    
    public function updateUser($id, $email = "", $firstName = "", $lastname = "", $password = "", $timezone = "", $userApiKey = "", $userName = "", $userSecretKey = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateUser", array(
            'id' => $id,
            'email' => $email,
            'firstname' => $firstName,
            'lastname' => $lastname,
            'password' => $password,
            'timezone' => $timezone,
            'userapikey' => $userApiKey,
            'username' => $userName,
            'usersecretkey' => $userSecretKey,
        ));
    }
    
    /**
    * Lists user accounts
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $accountType List users by account type. Valid types include
    *        admin, domain-admin, read-only-admin, or user.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id List user by ID.
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $state List users by state of the user account.
    * @param string $userName List user by the username
    */
    
    public function listUsers($account = "", $accountType = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $state = "", $userName = "") {

        return $this->request("listUsers", array(
            'account' => $account,
            'accounttype' => $accountType,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'state' => $state,
            'username' => $userName,
        ));
    }
    
    /**
    * Locks a user account
    *
    * @param string $id Locks user by user ID.
    */
    
    public function lockUser($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("lockUser", array(
            'id' => $id,
        ));
    }
    
    /**
    * Disables a user account
    *
    * @param string $id Disables user by user ID.
    */
    
    public function disableUser($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("disableUser", array(
            'id' => $id,
        ));
    }
    
    /**
    * Enables a user account
    *
    * @param string $id Enables user by user ID.
    */
    
    public function enableUser($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("enableUser", array(
            'id' => $id,
        ));
    }
    
    /**
    * Find user account by API key
    *
    * @param string $userApiKey API key of the user
    */
    
    public function getUser($userApiKey) {

        if (empty($userApiKey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userApiKey"), MISSING_ARGUMENT);
        }

        return $this->request("getUser", array(
            'userapikey' => $userApiKey,
        ));
    }
    
    /**
    * This command allows a user to register for the developer API, returning a secret key and an API key. This request is made through the integration API port, so it is a privileged command and must be made on behalf of a user. It is up to the implementer just how the username and password are entered, and then how that translates to an integration API request. Both secret key and API key should be returned to the user
    *
    * @param string $id User id
    */
    
    public function registerUserKeys($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("registerUserKeys", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists all LDAP Users
    *
    * @param string $keyword List by keyword
    * @param string $listType Determines whether all ldap users are returned or just
    *        non-cloudstack users
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listLdapUsers($keyword = "", $listType = "", $page = "", $pageSize = "") {

        return $this->request("listLdapUsers", array(
            'keyword' => $keyword,
            'listtype' => $listType,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Import LDAP users
    *
    * @param string $accountType Type of the account.  Specify 0 for user, 1 for root
    *        admin, and 2 for domain admin
    * @param string $accountDetails details for account used to store specific
    *        parameters
    * @param string $domainId Specifies the domain to which the ldap users are to be
    *        imported. If no domain is specified, a domain will created using group
    *        parameter. If the group is also not specified, a domain name based on the OU
    *        information will be created. If no OU hierarchy exists, will be defaulted to
    *        ROOT domain
    * @param string $group Specifies the group name from which the ldap users are to
    *        be imported. If no group is specified, all the users will be imported.
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $timezone Specifies a timezone for this command. For more
    *        information on the timezone parameter, see Time Zone Format.
    */
    
    public function importLdapUsers($accountType, $accountDetails = "", $domainId = "", $group = "", $keyword = "", $page = "", $pageSize = "", $timezone = "") {

        if (empty($accountType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "accountType"), MISSING_ARGUMENT);
        }

        return $this->request("importLdapUsers", array(
            'accounttype' => $accountType,
            'accountdetails' => $accountDetails,
            'domainid' => $domainId,
            'group' => $group,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'timezone' => $timezone,
        ));
    }
    
    /**
    * Adds traffic type to a physical network
    *
    * @param string $physicalNetworkId the Physical Network ID
    * @param string $trafficType the trafficType to be added to the physical network
    * @param string $hypervNetworkLabel The network name label of the physical device
    *        dedicated to this traffic on a Hyperv host
    * @param string $isolationMethod Used if physical network has multiple isolation
    *        types and traffic type is public. Choose which isolation method. Valid options
    *        currently &#039;vlan&#039; or &#039;vxlan&#039;, defaults to &#039;vlan&#039;.
    * @param string $kvmNetworkLabel The network name label of the physical device
    *        dedicated to this traffic on a KVM host
    * @param string $vlan The VLAN id to be used for Management traffic by VMware
    *        host
    * @param string $vmwareNetworkLabel The network name label of the physical device
    *        dedicated to this traffic on a VMware host
    * @param string $xenNetworkLabel The network name label of the physical device
    *        dedicated to this traffic on a XenServer host
    */
    
    public function addTrafficType($physicalNetworkId, $trafficType, $hypervNetworkLabel = "", $isolationMethod = "", $kvmNetworkLabel = "", $vlan = "", $vmwareNetworkLabel = "", $xenNetworkLabel = "") {

        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }

        if (empty($trafficType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "trafficType"), MISSING_ARGUMENT);
        }

        return $this->request("addTrafficType", array(
            'physicalnetworkid' => $physicalNetworkId,
            'traffictype' => $trafficType,
            'hypervnetworklabel' => $hypervNetworkLabel,
            'isolationmethod' => $isolationMethod,
            'kvmnetworklabel' => $kvmNetworkLabel,
            'vlan' => $vlan,
            'vmwarenetworklabel' => $vmwareNetworkLabel,
            'xennetworklabel' => $xenNetworkLabel,
        ));
    }
    
    /**
    * Deletes traffic type of a physical network
    *
    * @param string $id traffic type id
    */
    
    public function deleteTrafficType($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteTrafficType", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists traffic types of a given physical network.
    *
    * @param string $physicalNetworkId the Physical Network ID
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listTrafficTypes($physicalNetworkId, $keyword = "", $page = "", $pageSize = "") {

        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }

        return $this->request("listTrafficTypes", array(
            'physicalnetworkid' => $physicalNetworkId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Updates traffic type of a physical network
    *
    * @param string $id traffic type id
    * @param string $hypervNetworkLabel The network name label of the physical device
    *        dedicated to this traffic on a Hyperv host
    * @param string $kvmNetworkLabel The network name label of the physical device
    *        dedicated to this traffic on a KVM host
    * @param string $vmwareNetworkLabel The network name label of the physical device
    *        dedicated to this traffic on a VMware host
    * @param string $xenNetworkLabel The network name label of the physical device
    *        dedicated to this traffic on a XenServer host
    */
    
    public function updateTrafficType($id, $hypervNetworkLabel = "", $kvmNetworkLabel = "", $vmwareNetworkLabel = "", $xenNetworkLabel = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateTrafficType", array(
            'id' => $id,
            'hypervnetworklabel' => $hypervNetworkLabel,
            'kvmnetworklabel' => $kvmNetworkLabel,
            'vmwarenetworklabel' => $vmwareNetworkLabel,
            'xennetworklabel' => $xenNetworkLabel,
        ));
    }
    
    /**
    * Lists implementors of implementor of a network traffic type or implementors of all network traffic types
    *
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $trafficType Optional. The network traffic type, if specified,
    *        return its implementor. Otherwise, return all traffic types with their
    *        implementor
    */
    
    public function listTrafficTypeImplementors($keyword = "", $page = "", $pageSize = "", $trafficType = "") {

        return $this->request("listTrafficTypeImplementors", array(
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'traffictype' => $trafficType,
        ));
    }
    
    /**
    * Generates usage records. This will generate records only if there any records to be generated, i.e if the scheduled usage job was not run or failed
    *
    * @param string $endDate End date range for usage record query. Use yyyy-MM-dd as
    *        the date format, e.g. startDate=2009-06-03.
    * @param string $startDate Start date range for usage record query. Use yyyy-MM-dd
    *        as the date format, e.g. startDate=2009-06-01.
    * @param string $domainId List events for the specified domain.
    */
    
    public function generateUsageRecords($endDate, $startDate, $domainId = "") {

        if (empty($endDate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "endDate"), MISSING_ARGUMENT);
        }

        if (empty($startDate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "startDate"), MISSING_ARGUMENT);
        }

        return $this->request("generateUsageRecords", array(
            'enddate' => $endDate,
            'startdate' => $startDate,
            'domainid' => $domainId,
        ));
    }
    
    /**
    * Lists usage records for accounts
    *
    * @param string $endDate End date range for usage record query. Use yyyy-MM-dd as
    *        the date format, e.g. startDate=2009-06-03.
    * @param string $startDate Start date range for usage record query. Use yyyy-MM-dd
    *        as the date format, e.g. startDate=2009-06-01.
    * @param string $account List usage records for the specified user.
    * @param string $accountId List usage records for the specified account
    * @param string $domainId List usage records for the specified domain.
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId List usage records for specified project
    * @param string $type List usage records for the specified usage type
    */
    
    public function listUsageRecords($endDate, $startDate, $account = "", $accountId = "", $domainId = "", $keyword = "", $page = "", $pageSize = "", $projectId = "", $type = "") {

        if (empty($endDate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "endDate"), MISSING_ARGUMENT);
        }

        if (empty($startDate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "startDate"), MISSING_ARGUMENT);
        }

        return $this->request("listUsageRecords", array(
            'enddate' => $endDate,
            'startdate' => $startDate,
            'account' => $account,
            'accountid' => $accountId,
            'domainid' => $domainId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'type' => $type,
        ));
    }
    
    /**
    * List Usage Types
    *
    */
    
    public function listUsageTypes() {

        return $this->request("listUsageTypes", array(
        ));
    }
    
    /**
    * Adds Traffic Monitor Host for Direct Network Usage
    *
    * @param string $url URL of the traffic monitor Host
    * @param string $zoneId Zone in which to add the external firewall appliance.
    * @param string $excludeZones Traffic going into the listed zones will not be
    *        metered
    * @param string $includeZones Traffic going into the listed zones will be metered
    */
    
    public function addTrafficMonitor($url, $zoneId, $excludeZones = "", $includeZones = "") {

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("addTrafficMonitor", array(
            'url' => $url,
            'zoneid' => $zoneId,
            'excludezones' => $excludeZones,
            'includezones' => $includeZones,
        ));
    }
    
    /**
    * Deletes an traffic monitor host.
    *
    * @param string $id Id of the Traffic Monitor Host.
    */
    
    public function deleteTrafficMonitor($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteTrafficMonitor", array(
            'id' => $id,
        ));
    }
    
    /**
    * List traffic monitor Hosts.
    *
    * @param string $zoneId zone Id
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listTrafficMonitors($zoneId, $keyword = "", $page = "", $pageSize = "") {

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("listTrafficMonitors", array(
            'zoneid' => $zoneId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Creates an instant snapshot of a volume.
    *
    * @param string $volumeId The ID of the disk volume
    * @param string $account The account of the snapshot. The account parameter must
    *        be used with the domainId parameter.
    * @param string $domainId The domain ID of the snapshot. If used with the account
    *        parameter, specifies a domain for the account associated with the disk volume.
    * @param string $policyId policy id of the snapshot, if this is null, then use
    *        MANUAL_POLICY.
    * @param string $quiesceVm quiesce vm if true
    */
    
    public function createSnapshot($volumeId, $account = "", $domainId = "", $policyId = "", $quiesceVm = "") {

        if (empty($volumeId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "volumeId"), MISSING_ARGUMENT);
        }

        return $this->request("createSnapshot", array(
            'volumeid' => $volumeId,
            'account' => $account,
            'domainid' => $domainId,
            'policyid' => $policyId,
            'quiescevm' => $quiesceVm,
        ));
    }
    
    /**
    * Lists all available snapshots for the account.
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id lists snapshot by snapshot ID
    * @param string $intervalType valid values are HOURLY, DAILY, WEEKLY, and
    *        MONTHLY.
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name lists snapshot by snapshot name
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $snapshotType valid values are MANUAL or RECURRING.
    * @param string $tags List resources by tags (key/value pairs)
    * @param string $volumeId the ID of the disk volume
    * @param string $zoneId list snapshots by zone id
    */
    
    public function listSnapshots($account = "", $domainId = "", $id = "", $intervalType = "", $isRecursive = "", $keyword = "", $listAll = "", $name = "", $page = "", $pageSize = "", $projectId = "", $snapshotType = "", $tags = "", $volumeId = "", $zoneId = "") {

        return $this->request("listSnapshots", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'intervaltype' => $intervalType,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'snapshottype' => $snapshotType,
            'tags' => $tags,
            'volumeid' => $volumeId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Deletes a snapshot of a disk volume.
    *
    * @param string $id The ID of the snapshot
    */
    
    public function deleteSnapshot($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteSnapshot", array(
            'id' => $id,
        ));
    }
    
    /**
    * Creates a snapshot policy for the account.
    *
    * @param string $intervalType valid values are HOURLY, DAILY, WEEKLY, and MONTHLY
    * @param string $maxSnaps maximum number of snapshots to retain
    * @param string $schedule time the snapshot is scheduled to be taken. Format is:*
    *        if HOURLY, MM* if DAILY, MM:HH* if WEEKLY, MM:HH:DD (1-7)* if MONTHLY, MM:HH:DD
    *        (1-28)
    * @param string $timezone Specifies a timezone for this command. For more
    *        information on the timezone parameter, see Time Zone Format.
    * @param string $volumeId the ID of the disk volume
    */
    
    public function createSnapshotPolicy($intervalType, $maxSnaps, $schedule, $timezone, $volumeId) {

        if (empty($intervalType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "intervalType"), MISSING_ARGUMENT);
        }

        if (empty($maxSnaps)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "maxSnaps"), MISSING_ARGUMENT);
        }

        if (empty($schedule)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "schedule"), MISSING_ARGUMENT);
        }

        if (empty($timezone)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "timezone"), MISSING_ARGUMENT);
        }

        if (empty($volumeId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "volumeId"), MISSING_ARGUMENT);
        }

        return $this->request("createSnapshotPolicy", array(
            'intervaltype' => $intervalType,
            'maxsnaps' => $maxSnaps,
            'schedule' => $schedule,
            'timezone' => $timezone,
            'volumeid' => $volumeId,
        ));
    }
    
    /**
    * Deletes snapshot policies for the account.
    *
    * @param string $id the Id of the snapshot policy
    * @param string $ids list of snapshots policy IDs separated by comma
    */
    
    public function deleteSnapshotPolicies($id = "", $ids = "") {

        return $this->request("deleteSnapshotPolicies", array(
            'id' => $id,
            'ids' => $ids,
        ));
    }
    
    /**
    * Lists snapshot policies.
    *
    * @param string $volumeId the ID of the disk volume
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listSnapshotPolicies($volumeId, $keyword = "", $page = "", $pageSize = "") {

        if (empty($volumeId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "volumeId"), MISSING_ARGUMENT);
        }

        return $this->request("listSnapshotPolicies", array(
            'volumeid' => $volumeId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * revert a volume snapshot.
    *
    * @param string $id The ID of the snapshot
    */
    
    public function revertSnapshot($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("revertSnapshot", array(
            'id' => $id,
        ));
    }
    
    /**
    * List virtual machine snapshot by conditions
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name lists snapshot by snapshot name or display name
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $state state of the virtual machine snapshot
    * @param string $tags List resources by tags (key/value pairs)
    * @param string $virtualMachineId the ID of the vm
    * @param string $vmSnapshotId The ID of the VM snapshot
    */
    
    public function listVMSnapshot($account = "", $domainId = "", $isRecursive = "", $keyword = "", $listAll = "", $name = "", $page = "", $pageSize = "", $projectId = "", $state = "", $tags = "", $virtualMachineId = "", $vmSnapshotId = "") {

        return $this->request("listVMSnapshot", array(
            'account' => $account,
            'domainid' => $domainId,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'state' => $state,
            'tags' => $tags,
            'virtualmachineid' => $virtualMachineId,
            'vmsnapshotid' => $vmSnapshotId,
        ));
    }
    
    /**
    * Creates snapshot for a vm.
    *
    * @param string $virtualMachineId The ID of the vm
    * @param string $description The discription of the snapshot
    * @param string $name The display name of the snapshot
    * @param string $quiesceVm quiesce vm if true
    * @param string $snapshotMemory snapshot memory if true
    */
    
    public function createVMSnapshot($virtualMachineId, $description = "", $name = "", $quiesceVm = "", $snapshotMemory = "") {

        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }

        return $this->request("createVMSnapshot", array(
            'virtualmachineid' => $virtualMachineId,
            'description' => $description,
            'name' => $name,
            'quiescevm' => $quiesceVm,
            'snapshotmemory' => $snapshotMemory,
        ));
    }
    
    /**
    * Deletes a vmsnapshot.
    *
    * @param string $vmSnapshotId The ID of the VM snapshot
    */
    
    public function deleteVMSnapshot($vmSnapshotId) {

        if (empty($vmSnapshotId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vmSnapshotId"), MISSING_ARGUMENT);
        }

        return $this->request("deleteVMSnapshot", array(
            'vmsnapshotid' => $vmSnapshotId,
        ));
    }
    
    /**
    * Revert VM from a vmsnapshot.
    *
    * @param string $vmSnapshotId The ID of the vm snapshot
    */
    
    public function revertToVMSnapshot($vmSnapshotId) {

        if (empty($vmSnapshotId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vmSnapshotId"), MISSING_ARGUMENT);
        }

        return $this->request("revertToVMSnapshot", array(
            'vmsnapshotid' => $vmSnapshotId,
        ));
    }
    
    /**
    * Creates an account
    *
    * @param string $accountType Type of the account.  Specify 0 for user, 1 for root
    *        admin, and 2 for domain admin
    * @param string $email email
    * @param string $firstName firstname
    * @param string $lastname lastname
    * @param string $password Clear text password (Default hashed to SHA256SALT). If
    *        you wish to use any other hashing algorithm, you would need to write a custom
    *        authentication adapter See Docs section.
    * @param string $userName Unique username.
    * @param string $account Creates the user under the specified account. If no
    *        account is specified, the username will be used as the account name.
    * @param string $accountDetails details for account used to store specific
    *        parameters
    * @param string $accountId Account UUID, required for adding account from external
    *        provisioning system
    * @param string $domainId Creates the user under the specified domain.
    * @param string $networkDomain Network domain for the account&#039;s networks
    * @param string $timezone Specifies a timezone for this command. For more
    *        information on the timezone parameter, see Time Zone Format.
    * @param string $userId User UUID, required for adding account from external
    *        provisioning system
    */
    
    public function createAccount($accountType, $email, $firstName, $lastname, $password, $userName, $account = "", $accountDetails = "", $accountId = "", $domainId = "", $networkDomain = "", $timezone = "", $userId = "") {

        if (empty($accountType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "accountType"), MISSING_ARGUMENT);
        }

        if (empty($email)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "email"), MISSING_ARGUMENT);
        }

        if (empty($firstName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "firstName"), MISSING_ARGUMENT);
        }

        if (empty($lastname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lastname"), MISSING_ARGUMENT);
        }

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        return $this->request("createAccount", array(
            'accounttype' => $accountType,
            'email' => $email,
            'firstname' => $firstName,
            'lastname' => $lastname,
            'password' => $password,
            'username' => $userName,
            'account' => $account,
            'accountdetails' => $accountDetails,
            'accountid' => $accountId,
            'domainid' => $domainId,
            'networkdomain' => $networkDomain,
            'timezone' => $timezone,
            'userid' => $userId,
        ));
    }
    
    /**
    * Deletes a account, and all users associated with this account
    *
    * @param string $id Account id
    */
    
    public function deleteAccount($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteAccount", array(
            'id' => $id,
        ));
    }
    
    /**
    * Updates account information for the authenticated user
    *
    * @param string $newName new name for the account
    * @param string $account the current account name
    * @param string $accountDetails details for account used to store specific
    *        parameters
    * @param string $domainId the ID of the domain where the account exists
    * @param string $id Account id
    * @param string $networkDomain Network domain for the account&#039;s networks;
    *        empty string will update domainName with NULL value
    */
    
    public function updateAccount($newName, $account = "", $accountDetails = "", $domainId = "", $id = "", $networkDomain = "") {

        if (empty($newName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "newName"), MISSING_ARGUMENT);
        }

        return $this->request("updateAccount", array(
            'newname' => $newName,
            'account' => $account,
            'accountdetails' => $accountDetails,
            'domainid' => $domainId,
            'id' => $id,
            'networkdomain' => $networkDomain,
        ));
    }
    
    /**
    * Disables an account
    *
    * @param string $lock If true, only lock the account; else disable the account
    * @param string $account Disables specified account.
    * @param string $domainId Disables specified account in this domain.
    * @param string $id Account id
    */
    
    public function disableAccount($lock, $account = "", $domainId = "", $id = "") {

        if (empty($lock)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lock"), MISSING_ARGUMENT);
        }

        return $this->request("disableAccount", array(
            'lock' => $lock,
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
        ));
    }
    
    /**
    * Enables an account
    *
    * @param string $account Enables specified account.
    * @param string $domainId Enables specified account in this domain.
    * @param string $id Account id
    */
    
    public function enableAccount($account = "", $domainId = "", $id = "") {

        return $this->request("enableAccount", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
        ));
    }
    
    /**
    * Locks an account
    *
    * @param string $account Locks the specified account.
    * @param string $domainId Locks the specified account on this domain.
    */
    
    public function lockAccount($account, $domainId) {

        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }

        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }

        return $this->request("lockAccount", array(
            'account' => $account,
            'domainid' => $domainId,
        ));
    }
    
    /**
    * Lists accounts and provides detailed account information for listed accounts
    *
    * @param string $accountType list accounts by account type. Valid account types
    *        are 1 (admin), 2 (domain-admin), and 0 (user).
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id list account by account ID
    * @param string $isCleanUpRequired list accounts by cleanuprequred attribute
    *        (values are true or false)
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name list account by account name
    * @param string $page 
    * @param string $pageSize 
    * @param string $state list accounts by state. Valid states are enabled, disabled,
    *        and locked.
    */
    
    public function listAccounts($accountType = "", $domainId = "", $id = "", $isCleanUpRequired = "", $isRecursive = "", $keyword = "", $listAll = "", $name = "", $page = "", $pageSize = "", $state = "") {

        return $this->request("listAccounts", array(
            'accounttype' => $accountType,
            'domainid' => $domainId,
            'id' => $id,
            'iscleanuprequired' => $isCleanUpRequired,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'state' => $state,
        ));
    }
    
    /**
    * Marks a default zone for this account
    *
    * @param string $account Name of the account that is to be marked.
    * @param string $domainId Marks the account that belongs to the specified domain.
    * @param string $zoneId The Zone ID with which the account is to be marked.
    */
    
    public function markDefaultZoneForAccount($account, $domainId, $zoneId) {

        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }

        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("markDefaultZoneForAccount", array(
            'account' => $account,
            'domainid' => $domainId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Adds acoount to a project
    *
    * @param string $projectId id of the project to add the account to
    * @param string $account name of the account to be added to the project
    * @param string $email email to which invitation to the project is going to be
    *        sent
    */
    
    public function addAccountToProject($projectId, $account = "", $email = "") {

        if (empty($projectId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "projectId"), MISSING_ARGUMENT);
        }

        return $this->request("addAccountToProject", array(
            'projectid' => $projectId,
            'account' => $account,
            'email' => $email,
        ));
    }
    
    /**
    * Deletes account from the project
    *
    * @param string $account name of the account to be removed from the project
    * @param string $projectId id of the project to remove the account from
    */
    
    public function deleteAccountFromProject($account, $projectId) {

        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }

        if (empty($projectId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "projectId"), MISSING_ARGUMENT);
        }

        return $this->request("deleteAccountFromProject", array(
            'account' => $account,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * Lists project's accounts
    *
    * @param string $projectId id of the project
    * @param string $account list accounts of the project by account name
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $role list accounts of the project by role
    */
    
    public function listProjectAccounts($projectId, $account = "", $keyword = "", $page = "", $pageSize = "", $role = "") {

        if (empty($projectId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "projectId"), MISSING_ARGUMENT);
        }

        return $this->request("listProjectAccounts", array(
            'projectid' => $projectId,
            'account' => $account,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'role' => $role,
        ));
    }
    
    /**
    * Creates a Zone.
    *
    * @param string $dns1 the first DNS for the Zone
    * @param string $internalDns1 the first internal DNS for the Zone
    * @param string $name the name of the Zone
    * @param string $networkType network type of the zone, can be Basic or Advanced
    * @param string $allocationState Allocation state of this Zone for allocation of
    *        new resources
    * @param string $dns2 the second DNS for the Zone
    * @param string $domain Network domain name for the networks in the zone
    * @param string $domainId the ID of the containing domain, null for public zones
    * @param string $guestCidrAddress the guest CIDR address for the Zone
    * @param string $internalDns2 the second internal DNS for the Zone
    * @param string $ip6Dns1 the first DNS for IPv6 network in the Zone
    * @param string $ip6Dns2 the second DNS for IPv6 network in the Zone
    * @param string $localStorageEnabled true if local storage offering enabled, false
    *        otherwise
    * @param string $securityGroupEnabled true if network is security group enabled,
    *        false otherwise
    */
    
    public function createZone($dns1, $internalDns1, $name, $networkType, $allocationState = "", $dns2 = "", $domain = "", $domainId = "", $guestCidrAddress = "", $internalDns2 = "", $ip6Dns1 = "", $ip6Dns2 = "", $localStorageEnabled = "", $securityGroupEnabled = "") {

        if (empty($dns1)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "dns1"), MISSING_ARGUMENT);
        }

        if (empty($internalDns1)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "internalDns1"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($networkType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkType"), MISSING_ARGUMENT);
        }

        return $this->request("createZone", array(
            'dns1' => $dns1,
            'internaldns1' => $internalDns1,
            'name' => $name,
            'networktype' => $networkType,
            'allocationstate' => $allocationState,
            'dns2' => $dns2,
            'domain' => $domain,
            'domainid' => $domainId,
            'guestcidraddress' => $guestCidrAddress,
            'internaldns2' => $internalDns2,
            'ip6dns1' => $ip6Dns1,
            'ip6dns2' => $ip6Dns2,
            'localstorageenabled' => $localStorageEnabled,
            'securitygroupenabled' => $securityGroupEnabled,
        ));
    }
    
    /**
    * Updates a Zone.
    *
    * @param string $id the ID of the Zone
    * @param string $allocationState Allocation state of this cluster for allocation
    *        of new resources
    * @param string $details the details for the Zone
    * @param string $dhcpProvider the dhcp Provider for the Zone
    * @param string $dns1 the first DNS for the Zone
    * @param string $dns2 the second DNS for the Zone
    * @param string $dnsSearchOrder the dns search order list
    * @param string $domain Network domain name for the networks in the zone; empty
    *        string will update domain with NULL value
    * @param string $guestCidrAddress the guest CIDR address for the Zone
    * @param string $internalDns1 the first internal DNS for the Zone
    * @param string $internalDns2 the second internal DNS for the Zone
    * @param string $ip6Dns1 the first DNS for IPv6 network in the Zone
    * @param string $ip6Dns2 the second DNS for IPv6 network in the Zone
    * @param string $isPublic updates a private zone to public if set, but not
    *        vice-versa
    * @param string $localStorageEnabled true if local storage offering enabled, false
    *        otherwise
    * @param string $name the name of the Zone
    */
    
    public function updateZone($id, $allocationState = "", $details = "", $dhcpProvider = "", $dns1 = "", $dns2 = "", $dnsSearchOrder = "", $domain = "", $guestCidrAddress = "", $internalDns1 = "", $internalDns2 = "", $ip6Dns1 = "", $ip6Dns2 = "", $isPublic = "", $localStorageEnabled = "", $name = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateZone", array(
            'id' => $id,
            'allocationstate' => $allocationState,
            'details' => $details,
            'dhcpprovider' => $dhcpProvider,
            'dns1' => $dns1,
            'dns2' => $dns2,
            'dnssearchorder' => $dnsSearchOrder,
            'domain' => $domain,
            'guestcidraddress' => $guestCidrAddress,
            'internaldns1' => $internalDns1,
            'internaldns2' => $internalDns2,
            'ip6dns1' => $ip6Dns1,
            'ip6dns2' => $ip6Dns2,
            'ispublic' => $isPublic,
            'localstorageenabled' => $localStorageEnabled,
            'name' => $name,
        ));
    }
    
    /**
    * Deletes a Zone.
    *
    * @param string $id the ID of the Zone
    */
    
    public function deleteZone($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteZone", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists zones
    *
    * @param string $available true if you want to retrieve all available Zones. False
    *        if you only want to return the Zones from which you have at least one VM.
    *        Default is false.
    * @param string $domainId the ID of the domain associated with the zone
    * @param string $id the ID of the zone
    * @param string $keyword List by keyword
    * @param string $name the name of the zone
    * @param string $networkType the network type of the zone that the virtual machine
    *        belongs to
    * @param string $page 
    * @param string $pageSize 
    * @param string $showCapacities flag to display the capacity of the zones
    * @param string $tags List zones by resource tags (key/value pairs)
    */
    
    public function listZones($available = "", $domainId = "", $id = "", $keyword = "", $name = "", $networkType = "", $page = "", $pageSize = "", $showCapacities = "", $tags = "") {

        return $this->request("listZones", array(
            'available' => $available,
            'domainid' => $domainId,
            'id' => $id,
            'keyword' => $keyword,
            'name' => $name,
            'networktype' => $networkType,
            'page' => $page,
            'pagesize' => $pageSize,
            'showcapacities' => $showCapacities,
            'tags' => $tags,
        ));
    }
    
    /**
    * Adds a VMware datacenter to specified zone
    *
    * @param string $name Name of VMware datacenter to be added to specified zone.
    * @param string $vCenter The name/ip of vCenter. Make sure it is IP address or
    *        full qualified domain name for host running vCenter server.
    * @param string $zoneId The Zone ID.
    * @param string $password The password for specified username.
    * @param string $userName The Username required to connect to resource.
    */
    
    public function addVmwareDc($name, $vCenter, $zoneId, $password = "", $userName = "") {

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($vCenter)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vCenter"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("addVmwareDc", array(
            'name' => $name,
            'vcenter' => $vCenter,
            'zoneid' => $zoneId,
            'password' => $password,
            'username' => $userName,
        ));
    }
    
    /**
    * Remove a VMware datacenter from a zone.
    *
    * @param string $zoneId The id of Zone from which VMware datacenter has to be
    *        removed.
    */
    
    public function removeVmwareDc($zoneId) {

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("removeVmwareDc", array(
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Retrieves VMware DC(s) associated with a zone.
    *
    * @param string $zoneId Id of the CloudStack zone.
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listVmwareDcs($zoneId, $keyword = "", $page = "", $pageSize = "") {

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("listVmwareDcs", array(
            'zoneid' => $zoneId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Dedicates a zones.
    *
    * @param string $domainId the ID of the containing domain
    * @param string $zoneId the ID of the zone
    * @param string $account the name of the account which needs dedication. Must be
    *        used with domainId.
    */
    
    public function dedicateZone($domainId, $zoneId, $account = "") {

        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("dedicateZone", array(
            'domainid' => $domainId,
            'zoneid' => $zoneId,
            'account' => $account,
        ));
    }
    
    /**
    * Release dedication of zone
    *
    * @param string $zoneId the ID of the Zone
    */
    
    public function releaseDedicatedZone($zoneId) {

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("releaseDedicatedZone", array(
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * List dedicated zones.
    *
    * @param string $account the name of the account associated with the zone. Must be
    *        used with domainId.
    * @param string $affinityGroupId list dedicated zones by affinity group
    * @param string $domainId the ID of the domain associated with the zone
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $zoneId the ID of the Zone
    */
    
    public function listDedicatedZones($account = "", $affinityGroupId = "", $domainId = "", $keyword = "", $page = "", $pageSize = "", $zoneId = "") {

        return $this->request("listDedicatedZones", array(
            'account' => $account,
            'affinitygroupid' => $affinityGroupId,
            'domainid' => $domainId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Attaches an ISO to a virtual machine.
    *
    * @param string $id the ID of the ISO file
    * @param string $virtualMachineId the ID of the virtual machine
    */
    
    public function attachIso($id, $virtualMachineId) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }

        return $this->request("attachIso", array(
            'id' => $id,
            'virtualmachineid' => $virtualMachineId,
        ));
    }
    
    /**
    * Detaches any ISO file (if any) currently attached to a virtual machine.
    *
    * @param string $virtualMachineId The ID of the virtual machine
    */
    
    public function detachIso($virtualMachineId) {

        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }

        return $this->request("detachIso", array(
            'virtualmachineid' => $virtualMachineId,
        ));
    }
    
    /**
    * Lists all available ISO files.
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $bootable true if the ISO is bootable, false otherwise
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $hypervisor the hypervisor for which to restrict the search
    * @param string $id list ISO by id
    * @param string $isoFilter possible values are &quot;featured&quot;,
    *        &quot;self&quot;,
    *        &quot;selfexecutable&quot;,&quot;sharedexecutable&quot;,&quot;executable&quot;,
    *        and &quot;community&quot;. * featured : templates that have been marked as
    *        featured and public. * self : templates that have been registered or created by
    *        the calling user. * selfexecutable : same as self, but only returns templates
    *        that can be used to deploy a new VM. * sharedexecutable : templates ready to be
    *        deployed that have been granted to the calling user by another user. *
    *        executable : templates that are owned by the calling user, or public templates,
    *        that can be used to deploy a VM. * community : templates that have been marked
    *        as public but not featured. * all : all templates (only usable by admins).
    * @param string $isPublic true if the ISO is publicly available to all users,
    *        false otherwise.
    * @param string $isReady true if this ISO is ready to be deployed
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name list all isos by name
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $showRemoved show removed ISOs as well
    * @param string $tags List resources by tags (key/value pairs)
    * @param string $zoneId the ID of the zone
    */
    
    public function listIsos($account = "", $bootable = "", $domainId = "", $hypervisor = "", $id = "", $isoFilter = "", $isPublic = "", $isReady = "", $isRecursive = "", $keyword = "", $listAll = "", $name = "", $page = "", $pageSize = "", $projectId = "", $showRemoved = "", $tags = "", $zoneId = "") {

        return $this->request("listIsos", array(
            'account' => $account,
            'bootable' => $bootable,
            'domainid' => $domainId,
            'hypervisor' => $hypervisor,
            'id' => $id,
            'isofilter' => $isoFilter,
            'ispublic' => $isPublic,
            'isready' => $isReady,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'showremoved' => $showRemoved,
            'tags' => $tags,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Registers an existing ISO into the CloudStack Cloud.
    *
    * @param string $displayText the display text of the ISO. This is usually used for
    *        display purposes.
    * @param string $name the name of the ISO
    * @param string $url the URL to where the ISO is currently being hosted
    * @param string $zoneId the ID of the zone you wish to register the ISO to.
    * @param string $account an optional account name. Must be used with domainId.
    * @param string $bootable true if this ISO is bootable. If not passed explicitly
    *        its assumed to be true
    * @param string $checksum the MD5 checksum value of this ISO
    * @param string $domainId an optional domainId. If the account parameter is used,
    *        domainId must also be used.
    * @param string $imageStoreUuid Image store uuid
    * @param string $isDynamicallyScalable true if iso contains XS/VMWare tools
    *        inorder to support dynamic scaling of VM cpu/memory
    * @param string $isExtractable true if the iso or its derivatives are extractable;
    *        default is false
    * @param string $isFeatured true if you want this ISO to be featured
    * @param string $isPublic true if you want to register the ISO to be publicly
    *        available to all users, false otherwise.
    * @param string $osTypeId the ID of the OS Type that best represents the OS of
    *        this ISO. If the iso is bootable this parameter needs to be passed
    * @param string $projectId Register iso for the project
    */
    
    public function registerIso($displayText, $name, $url, $zoneId, $account = "", $bootable = "", $checksum = "", $domainId = "", $imageStoreUuid = "", $isDynamicallyScalable = "", $isExtractable = "", $isFeatured = "", $isPublic = "", $osTypeId = "", $projectId = "") {

        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("registerIso", array(
            'displaytext' => $displayText,
            'name' => $name,
            'url' => $url,
            'zoneid' => $zoneId,
            'account' => $account,
            'bootable' => $bootable,
            'checksum' => $checksum,
            'domainid' => $domainId,
            'imagestoreuuid' => $imageStoreUuid,
            'isdynamicallyscalable' => $isDynamicallyScalable,
            'isextractable' => $isExtractable,
            'isfeatured' => $isFeatured,
            'ispublic' => $isPublic,
            'ostypeid' => $osTypeId,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * Updates an ISO file.
    *
    * @param string $id the ID of the image file
    * @param string $bootable true if image is bootable, false otherwise
    * @param string $displayText the display text of the image
    * @param string $format the format for the image
    * @param string $isDynamicallyScalable true if template/ISO contains XS/VMWare
    *        tools inorder to support dynamic scaling of VM cpu/memory
    * @param string $isRouting true if the template type is routing i.e., if template
    *        is used to deploy router
    * @param string $name the name of the image file
    * @param string $osTypeId the ID of the OS type that best represents the OS of
    *        this image.
    * @param string $passwordEnabled true if the image supports the password reset
    *        feature; default is false
    * @param string $sortKey sort key of the template, integer
    */
    
    public function updateIso($id, $bootable = "", $displayText = "", $format = "", $isDynamicallyScalable = "", $isRouting = "", $name = "", $osTypeId = "", $passwordEnabled = "", $sortKey = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateIso", array(
            'id' => $id,
            'bootable' => $bootable,
            'displaytext' => $displayText,
            'format' => $format,
            'isdynamicallyscalable' => $isDynamicallyScalable,
            'isrouting' => $isRouting,
            'name' => $name,
            'ostypeid' => $osTypeId,
            'passwordenabled' => $passwordEnabled,
            'sortkey' => $sortKey,
        ));
    }
    
    /**
    * Deletes an ISO file.
    *
    * @param string $id the ID of the ISO file
    * @param string $zoneId the ID of the zone of the ISO file. If not specified, the
    *        ISO will be deleted from all the zones
    */
    
    public function deleteIso($id, $zoneId = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteIso", array(
            'id' => $id,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Copies an iso from one zone to another.
    *
    * @param string $id Template ID.
    * @param string $destzoneId ID of the zone the template is being copied to.
    * @param string $sourceZoneId ID of the zone the template is currently hosted on.
    *        If not specified and template is cross-zone, then we will sync this template to
    *        region wide image store
    */
    
    public function copyIso($id, $destzoneId, $sourceZoneId = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($destzoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "destzoneId"), MISSING_ARGUMENT);
        }

        return $this->request("copyIso", array(
            'id' => $id,
            'destzoneid' => $destzoneId,
            'sourcezoneid' => $sourceZoneId,
        ));
    }
    
    /**
    * Updates iso permissions
    *
    * @param string $id the template ID
    * @param string $accounts a comma delimited list of accounts. If specified,
    *        &quot;op&quot; parameter has to be passed in.
    * @param string $isExtractable true if the template/iso is extractable, false
    *        other wise. Can be set only by root admin
    * @param string $isFeatured true for featured template/iso, false otherwise
    * @param string $isPublic true for public template/iso, false for private
    *        templates/isos
    * @param string $op permission operator (add, remove, reset)
    * @param string $projectids a comma delimited list of projects. If specified,
    *        &quot;op&quot; parameter has to be passed in.
    */
    
    public function updateIsoPermissions($id, $accounts = "", $isExtractable = "", $isFeatured = "", $isPublic = "", $op = "", $projectids = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateIsoPermissions", array(
            'id' => $id,
            'accounts' => $accounts,
            'isextractable' => $isExtractable,
            'isfeatured' => $isFeatured,
            'ispublic' => $isPublic,
            'op' => $op,
            'projectids' => $projectids,
        ));
    }
    
    /**
    * List iso visibility and all accounts that have permissions to view this iso.
    *
    * @param string $id the template ID
    */
    
    public function listIsoPermissions($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("listIsoPermissions", array(
            'id' => $id,
        ));
    }
    
    /**
    * Extracts an ISO
    *
    * @param string $id the ID of the ISO file
    * @param string $mode the mode of extraction - HTTP_DOWNLOAD or FTP_UPLOAD
    * @param string $url the url to which the ISO would be extracted
    * @param string $zoneId the ID of the zone where the ISO is originally located
    */
    
    public function extractIso($id, $mode, $url = "", $zoneId = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($mode)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "mode"), MISSING_ARGUMENT);
        }

        return $this->request("extractIso", array(
            'id' => $id,
            'mode' => $mode,
            'url' => $url,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * delete a Cisco Nexus VSM device
    *
    * @param string $id Id of the Cisco Nexus 1000v VSM device to be deleted
    */
    
    public function deleteCiscoNexusVSM($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteCiscoNexusVSM", array(
            'id' => $id,
        ));
    }
    
    /**
    * Enable a Cisco Nexus VSM device
    *
    * @param string $id Id of the Cisco Nexus 1000v VSM device to be enabled
    */
    
    public function enableCiscoNexusVSM($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("enableCiscoNexusVSM", array(
            'id' => $id,
        ));
    }
    
    /**
    * disable a Cisco Nexus VSM device
    *
    * @param string $id Id of the Cisco Nexus 1000v VSM device to be deleted
    */
    
    public function disableCiscoNexusVSM($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("disableCiscoNexusVSM", array(
            'id' => $id,
        ));
    }
    
    /**
    * Retrieves a Cisco Nexus 1000v Virtual Switch Manager device associated with a Cluster
    *
    * @param string $clusterId Id of the CloudStack cluster in which the Cisco Nexus
    *        1000v VSM appliance.
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $zoneId Id of the CloudStack cluster in which the Cisco Nexus
    *        1000v VSM appliance.
    */
    
    public function listCiscoNexusVSMs($clusterId = "", $keyword = "", $page = "", $pageSize = "", $zoneId = "") {

        return $this->request("listCiscoNexusVSMs", array(
            'clusterid' => $clusterId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Adds a Cisco Vnmc Controller
    *
    * @param string $hostname Hostname or ip address of the Cisco VNMC Controller.
    * @param string $password Credentials to access the Cisco VNMC Controller API
    * @param string $physicalNetworkId the Physical Network ID
    * @param string $userName Credentials to access the Cisco VNMC Controller API
    */
    
    public function addCiscoVnmcResource($hostname, $password, $physicalNetworkId, $userName) {

        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostname"), MISSING_ARGUMENT);
        }

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        return $this->request("addCiscoVnmcResource", array(
            'hostname' => $hostname,
            'password' => $password,
            'physicalnetworkid' => $physicalNetworkId,
            'username' => $userName,
        ));
    }
    
    /**
    * Deletes a Cisco Vnmc controller
    *
    * @param string $resourceId Cisco Vnmc resource ID
    */
    
    public function deleteCiscoVnmcResource($resourceId) {

        if (empty($resourceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceId"), MISSING_ARGUMENT);
        }

        return $this->request("deleteCiscoVnmcResource", array(
            'resourceid' => $resourceId,
        ));
    }
    
    /**
    * Lists Cisco VNMC controllers
    *
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $physicalNetworkId the Physical Network ID
    * @param string $resourceId Cisco VNMC resource ID
    */
    
    public function listCiscoVnmcResources($keyword = "", $page = "", $pageSize = "", $physicalNetworkId = "", $resourceId = "") {

        return $this->request("listCiscoVnmcResources", array(
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'physicalnetworkid' => $physicalNetworkId,
            'resourceid' => $resourceId,
        ));
    }
    
    /**
    * Adds a Cisco Asa 1000v appliance
    *
    * @param string $clusterId the Cluster ID
    * @param string $hostname Hostname or ip address of the Cisco ASA 1000v
    *        appliance.
    * @param string $insidePortProfile Nexus port profile associated with inside
    *        interface of ASA 1000v
    * @param string $physicalNetworkId the Physical Network ID
    */
    
    public function addCiscoAsa1000vResource($clusterId, $hostname, $insidePortProfile, $physicalNetworkId) {

        if (empty($clusterId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "clusterId"), MISSING_ARGUMENT);
        }

        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostname"), MISSING_ARGUMENT);
        }

        if (empty($insidePortProfile)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "insidePortProfile"), MISSING_ARGUMENT);
        }

        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }

        return $this->request("addCiscoAsa1000vResource", array(
            'clusterid' => $clusterId,
            'hostname' => $hostname,
            'insideportprofile' => $insidePortProfile,
            'physicalnetworkid' => $physicalNetworkId,
        ));
    }
    
    /**
    * Deletes a Cisco ASA 1000v appliance
    *
    * @param string $resourceId Cisco ASA 1000v resource ID
    */
    
    public function deleteCiscoAsa1000vResource($resourceId) {

        if (empty($resourceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceId"), MISSING_ARGUMENT);
        }

        return $this->request("deleteCiscoAsa1000vResource", array(
            'resourceid' => $resourceId,
        ));
    }
    
    /**
    * Lists Cisco ASA 1000v appliances
    *
    * @param string $hostname Hostname or ip address of the Cisco ASA 1000v
    *        appliance.
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $physicalNetworkId the Physical Network ID
    * @param string $resourceId Cisco ASA 1000v resource ID
    */
    
    public function listCiscoAsa1000vResources($hostname = "", $keyword = "", $page = "", $pageSize = "", $physicalNetworkId = "", $resourceId = "") {

        return $this->request("listCiscoAsa1000vResources", array(
            'hostname' => $hostname,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'physicalnetworkid' => $physicalNetworkId,
            'resourceid' => $resourceId,
        ));
    }
    
    /**
    * Starts a router.
    *
    * @param string $id the ID of the router
    */
    
    public function startRouter($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("startRouter", array(
            'id' => $id,
        ));
    }
    
    /**
    * Starts a router.
    *
    * @param string $id the ID of the router
    */
    
    public function rebootRouter($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("rebootRouter", array(
            'id' => $id,
        ));
    }
    
    /**
    * Stops a router.
    *
    * @param string $id the ID of the router
    * @param string $forced Force stop the VM. The caller knows the VM is stopped.
    */
    
    public function stopRouter($id, $forced = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("stopRouter", array(
            'id' => $id,
            'forced' => $forced,
        ));
    }
    
    /**
    * Destroys a router.
    *
    * @param string $id the ID of the router
    */
    
    public function destroyRouter($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("destroyRouter", array(
            'id' => $id,
        ));
    }
    
    /**
    * Upgrades domain router to a new service offering
    *
    * @param string $id The ID of the router
    * @param string $serviceOfferingId the service offering ID to apply to the domain
    *        router
    */
    
    public function changeServiceForRouter($id, $serviceOfferingId) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($serviceOfferingId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceOfferingId"), MISSING_ARGUMENT);
        }

        return $this->request("changeServiceForRouter", array(
            'id' => $id,
            'serviceofferingid' => $serviceOfferingId,
        ));
    }
    
    /**
    * List routers.
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $clusterId the cluster ID of the router
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $forVpc if true is passed for this parameter, list only VPC
    *        routers
    * @param string $hostId the host ID of the router
    * @param string $id the ID of the disk router
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name the name of the router
    * @param string $networkId list by network id
    * @param string $page 
    * @param string $pageSize 
    * @param string $podId the Pod ID of the router
    * @param string $projectId list objects by project
    * @param string $state the state of the router
    * @param string $version list virtual router elements by version
    * @param string $vpcId List networks by VPC
    * @param string $zoneId the Zone ID of the router
    */
    
    public function listRouters($account = "", $clusterId = "", $domainId = "", $forVpc = "", $hostId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $name = "", $networkId = "", $page = "", $pageSize = "", $podId = "", $projectId = "", $state = "", $version = "", $vpcId = "", $zoneId = "") {

        return $this->request("listRouters", array(
            'account' => $account,
            'clusterid' => $clusterId,
            'domainid' => $domainId,
            'forvpc' => $forVpc,
            'hostid' => $hostId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'name' => $name,
            'networkid' => $networkId,
            'page' => $page,
            'pagesize' => $pageSize,
            'podid' => $podId,
            'projectid' => $projectId,
            'state' => $state,
            'version' => $version,
            'vpcid' => $vpcId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Lists all available virtual router elements.
    *
    * @param string $enabled list network offerings by enabled state
    * @param string $id list virtual router elements by id
    * @param string $keyword List by keyword
    * @param string $nspId list virtual router elements by network service provider
    *        id
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listVirtualRouterElements($enabled = "", $id = "", $keyword = "", $nspId = "", $page = "", $pageSize = "") {

        return $this->request("listVirtualRouterElements", array(
            'enabled' => $enabled,
            'id' => $id,
            'keyword' => $keyword,
            'nspid' => $nspId,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Configures a virtual router element.
    *
    * @param string $id the ID of the virtual router provider
    * @param string $enabled Enabled/Disabled the service provider
    */
    
    public function configureVirtualRouterElement($id, $enabled) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($enabled)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "enabled"), MISSING_ARGUMENT);
        }

        return $this->request("configureVirtualRouterElement", array(
            'id' => $id,
            'enabled' => $enabled,
        ));
    }
    
    /**
    * Create a virtual router element.
    *
    * @param string $nspId the network service provider ID of the virtual router
    *        element
    * @param string $providerType The provider type. Supported types are VirtualRouter
    *        (default) and VPCVirtualRouter
    */
    
    public function createVirtualRouterElement($nspId, $providerType = "") {

        if (empty($nspId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nspId"), MISSING_ARGUMENT);
        }

        return $this->request("createVirtualRouterElement", array(
            'nspid' => $nspId,
            'providertype' => $providerType,
        ));
    }
    
    /**
    * Creates a project
    *
    * @param string $displayText display text of the project
    * @param string $name name of the project
    * @param string $account account who will be Admin for the project
    * @param string $domainId domain ID of the account owning a project
    */
    
    public function createProject($displayText, $name, $account = "", $domainId = "") {

        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        return $this->request("createProject", array(
            'displaytext' => $displayText,
            'name' => $name,
            'account' => $account,
            'domainid' => $domainId,
        ));
    }
    
    /**
    * Deletes a project
    *
    * @param string $id id of the project to be deleted
    */
    
    public function deleteProject($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteProject", array(
            'id' => $id,
        ));
    }
    
    /**
    * Updates a project
    *
    * @param string $id id of the project to be modified
    * @param string $account new Admin account for the project
    * @param string $displayText display text of the project
    */
    
    public function updateProject($id, $account = "", $displayText = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateProject", array(
            'id' => $id,
            'account' => $account,
            'displaytext' => $displayText,
        ));
    }
    
    /**
    * Activates a project
    *
    * @param string $id id of the project to be modified
    */
    
    public function activateProject($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("activateProject", array(
            'id' => $id,
        ));
    }
    
    /**
    * Suspends a project
    *
    * @param string $id id of the project to be suspended
    */
    
    public function suspendProject($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("suspendProject", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists projects and provides detailed information for listed projects
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $displayText list projects by display text
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id list projects by project ID
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name list projects by name
    * @param string $page 
    * @param string $pageSize 
    * @param string $state list projects by state
    * @param string $tags List projects by tags (key/value pairs)
    */
    
    public function listProjects($account = "", $displayText = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $name = "", $page = "", $pageSize = "", $state = "", $tags = "") {

        return $this->request("listProjects", array(
            'account' => $account,
            'displaytext' => $displayText,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'state' => $state,
            'tags' => $tags,
        ));
    }
    
    /**
    * Lists projects and provides detailed information for listed projects
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $activeOnly if true, list only active invitations - having Pending
    *        state and ones that are not timed out yet
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id list invitations by id
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list by project id
    * @param string $state list invitations by state
    */
    
    public function listProjectInvitations($account = "", $activeOnly = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $projectId = "", $state = "") {

        return $this->request("listProjectInvitations", array(
            'account' => $account,
            'activeonly' => $activeOnly,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'state' => $state,
        ));
    }
    
    /**
    * Accepts or declines project invitation
    *
    * @param string $projectId id of the project to join
    * @param string $accept if true, accept the invitation, decline if false. True by
    *        default
    * @param string $account account that is joining the project
    * @param string $token list invitations for specified account; this parameter has
    *        to be specified with domainId
    */
    
    public function updateProjectInvitation($projectId, $accept = "", $account = "", $token = "") {

        if (empty($projectId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "projectId"), MISSING_ARGUMENT);
        }

        return $this->request("updateProjectInvitation", array(
            'projectid' => $projectId,
            'accept' => $accept,
            'account' => $account,
            'token' => $token,
        ));
    }
    
    /**
    * Accepts or declines project invitation
    *
    * @param string $id id of the invitation
    */
    
    public function deleteProjectInvitation($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteProjectInvitation", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists storage pools.
    *
    * @param string $clusterId list storage pools belongig to the specific cluster
    * @param string $id the ID of the storage pool
    * @param string $ipAddress the IP address for the storage pool
    * @param string $keyword List by keyword
    * @param string $name the name of the storage pool
    * @param string $page 
    * @param string $pageSize 
    * @param string $path the storage pool path
    * @param string $podId the Pod ID for the storage pool
    * @param string $scope the ID of the storage pool
    * @param string $zoneId the Zone ID for the storage pool
    */
    
    public function listStoragePools($clusterId = "", $id = "", $ipAddress = "", $keyword = "", $name = "", $page = "", $pageSize = "", $path = "", $podId = "", $scope = "", $zoneId = "") {

        return $this->request("listStoragePools", array(
            'clusterid' => $clusterId,
            'id' => $id,
            'ipaddress' => $ipAddress,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'path' => $path,
            'podid' => $podId,
            'scope' => $scope,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Creates a storage pool.
    *
    * @param string $name the name for the storage pool
    * @param string $url the URL of the storage pool
    * @param string $zoneId the Zone ID for the storage pool
    * @param string $capacityBytes bytes CloudStack can provision from this storage
    *        pool
    * @param string $capacityIops IOPS CloudStack can provision from this storage
    *        pool
    * @param string $clusterId the cluster ID for the storage pool
    * @param string $details the details for the storage pool
    * @param string $hypervisor hypervisor type of the hosts in zone that will be
    *        attached to this storage pool. KVM, VMware supported as of now.
    * @param string $managed whether the storage should be managed by CloudStack
    * @param string $podId the Pod ID for the storage pool
    * @param string $provider the storage provider name
    * @param string $scope the scope of the storage: cluster or zone
    * @param string $tags the tags for the storage pool
    */
    
    public function createStoragePool($name, $url, $zoneId, $capacityBytes = "", $capacityIops = "", $clusterId = "", $details = "", $hypervisor = "", $managed = "", $podId = "", $provider = "", $scope = "", $tags = "") {

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("createStoragePool", array(
            'name' => $name,
            'url' => $url,
            'zoneid' => $zoneId,
            'capacitybytes' => $capacityBytes,
            'capacityiops' => $capacityIops,
            'clusterid' => $clusterId,
            'details' => $details,
            'hypervisor' => $hypervisor,
            'managed' => $managed,
            'podid' => $podId,
            'provider' => $provider,
            'scope' => $scope,
            'tags' => $tags,
        ));
    }
    
    /**
    * Updates a storage pool.
    *
    * @param string $id the Id of the storage pool
    * @param string $capacityBytes bytes CloudStack can provision from this storage
    *        pool
    * @param string $capacityIops IOPS CloudStack can provision from this storage
    *        pool
    * @param string $tags comma-separated list of tags for the storage pool
    */
    
    public function updateStoragePool($id, $capacityBytes = "", $capacityIops = "", $tags = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateStoragePool", array(
            'id' => $id,
            'capacitybytes' => $capacityBytes,
            'capacityiops' => $capacityIops,
            'tags' => $tags,
        ));
    }
    
    /**
    * Deletes a storage pool.
    *
    * @param string $id Storage pool id
    * @param string $forced Force destroy storage pool (force expunge volumes in
    *        Destroyed state as a part of pool removal)
    */
    
    public function deleteStoragePool($id, $forced = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteStoragePool", array(
            'id' => $id,
            'forced' => $forced,
        ));
    }
    
    /**
    * Lists storage pools available for migration of a volume.
    *
    * @param string $id the ID of the volume
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function findStoragePoolsForMigration($id, $keyword = "", $page = "", $pageSize = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("findStoragePoolsForMigration", array(
            'id' => $id,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Create a pool
    *
    * @param string $algorithm algorithm.
    * @param string $name pool name.
    */
    
    public function createPool($algorithm, $name) {

        if (empty($algorithm)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "algorithm"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        return $this->request("createPool", array(
            'algorithm' => $algorithm,
            'name' => $name,
        ));
    }
    
    /**
    * Delete a pool
    *
    * @param string $poolName pool name.
    */
    
    public function deletePool($poolName) {

        if (empty($poolName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "poolName"), MISSING_ARGUMENT);
        }

        return $this->request("deletePool", array(
            'poolname' => $poolName,
        ));
    }
    
    /**
    * Modify pool
    *
    * @param string $algorithm algorithm.
    * @param string $poolName pool name.
    */
    
    public function modifyPool($algorithm, $poolName) {

        if (empty($algorithm)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "algorithm"), MISSING_ARGUMENT);
        }

        if (empty($poolName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "poolName"), MISSING_ARGUMENT);
        }

        return $this->request("modifyPool", array(
            'algorithm' => $algorithm,
            'poolname' => $poolName,
        ));
    }
    
    /**
    * List Pool
    *
    */
    
    public function listPools() {

        return $this->request("listPools", array(
        ));
    }
    
    /**
    * Adds a Ucs manager
    *
    * @param string $password the password of UCS
    * @param string $url the name of UCS url
    * @param string $userName the username of UCS
    * @param string $zoneId the Zone id for the ucs manager
    * @param string $name the name of UCS manager
    */
    
    public function addUcsManager($password, $url, $userName, $zoneId, $name = "") {

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("addUcsManager", array(
            'password' => $password,
            'url' => $url,
            'username' => $userName,
            'zoneid' => $zoneId,
            'name' => $name,
        ));
    }
    
    /**
    * List ucs manager
    *
    * @param string $id the ID of the ucs manager
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $zoneId the zone id
    */
    
    public function listUcsManagers($id = "", $keyword = "", $page = "", $pageSize = "", $zoneId = "") {

        return $this->request("listUcsManagers", array(
            'id' => $id,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * List profile in ucs manager
    *
    * @param string $ucsManagerId the id for the ucs manager
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listUcsProfiles($ucsManagerId, $keyword = "", $page = "", $pageSize = "") {

        if (empty($ucsManagerId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsManagerId"), MISSING_ARGUMENT);
        }

        return $this->request("listUcsProfiles", array(
            'ucsmanagerid' => $ucsManagerId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * List ucs blades
    *
    * @param string $ucsManagerId ucs manager id
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listUcsBlades($ucsManagerId, $keyword = "", $page = "", $pageSize = "") {

        if (empty($ucsManagerId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsManagerId"), MISSING_ARGUMENT);
        }

        return $this->request("listUcsBlades", array(
            'ucsmanagerid' => $ucsManagerId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * associate a profile to a blade
    *
    * @param string $bladeId blade id
    * @param string $profileDn profile dn
    * @param string $ucsManagerId ucs manager id
    */
    
    public function associateUcsProfileToBlade($bladeId, $profileDn, $ucsManagerId) {

        if (empty($bladeId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "bladeId"), MISSING_ARGUMENT);
        }

        if (empty($profileDn)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "profileDn"), MISSING_ARGUMENT);
        }

        if (empty($ucsManagerId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsManagerId"), MISSING_ARGUMENT);
        }

        return $this->request("associateUcsProfileToBlade", array(
            'bladeid' => $bladeId,
            'profiledn' => $profileDn,
            'ucsmanagerid' => $ucsManagerId,
        ));
    }
    
    /**
    * Delete a Ucs manager
    *
    * @param string $ucsManagerId ucs manager id
    */
    
    public function deleteUcsManager($ucsManagerId) {

        if (empty($ucsManagerId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsManagerId"), MISSING_ARGUMENT);
        }

        return $this->request("deleteUcsManager", array(
            'ucsmanagerid' => $ucsManagerId,
        ));
    }
    
    /**
    * disassociate a profile from a blade
    *
    * @param string $bladeId blade id
    * @param string $deleteProfile is deleting profile after disassociating
    */
    
    public function disassociateUcsProfileFromBlade($bladeId, $deleteProfile = "") {

        if (empty($bladeId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "bladeId"), MISSING_ARGUMENT);
        }

        return $this->request("disassociateUcsProfileFromBlade", array(
            'bladeid' => $bladeId,
            'deleteprofile' => $deleteProfile,
        ));
    }
    
    /**
    * refresh ucs blades to sync with UCS manager
    *
    * @param string $ucsManagerId ucs manager id
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function refreshUcsBlades($ucsManagerId, $keyword = "", $page = "", $pageSize = "") {

        if (empty($ucsManagerId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsManagerId"), MISSING_ARGUMENT);
        }

        return $this->request("refreshUcsBlades", array(
            'ucsmanagerid' => $ucsManagerId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Starts a system virtual machine.
    *
    * @param string $id The ID of the system virtual machine
    */
    
    public function startSystemVm($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("startSystemVm", array(
            'id' => $id,
        ));
    }
    
    /**
    * Reboots a system VM.
    *
    * @param string $id The ID of the system virtual machine
    */
    
    public function rebootSystemVm($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("rebootSystemVm", array(
            'id' => $id,
        ));
    }
    
    /**
    * Stops a system VM.
    *
    * @param string $id The ID of the system virtual machine
    * @param string $forced Force stop the VM.  The caller knows the VM is stopped.
    */
    
    public function stopSystemVm($id, $forced = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("stopSystemVm", array(
            'id' => $id,
            'forced' => $forced,
        ));
    }
    
    /**
    * Destroyes a system virtual machine.
    *
    * @param string $id The ID of the system virtual machine
    */
    
    public function destroySystemVm($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("destroySystemVm", array(
            'id' => $id,
        ));
    }
    
    /**
    * List system virtual machines.
    *
    * @param string $hostId the host ID of the system VM
    * @param string $id the ID of the system VM
    * @param string $keyword List by keyword
    * @param string $name the name of the system VM
    * @param string $page 
    * @param string $pageSize 
    * @param string $podId the Pod ID of the system VM
    * @param string $state the state of the system VM
    * @param string $storageId the storage ID where vm&#039;s volumes belong to
    * @param string $systemVmType the system VM type. Possible types are
    *        &quot;consoleproxy&quot; and &quot;secondarystoragevm&quot;.
    * @param string $zoneId the Zone ID of the system VM
    */
    
    public function listSystemVms($hostId = "", $id = "", $keyword = "", $name = "", $page = "", $pageSize = "", $podId = "", $state = "", $storageId = "", $systemVmType = "", $zoneId = "") {

        return $this->request("listSystemVms", array(
            'hostid' => $hostId,
            'id' => $id,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'podid' => $podId,
            'state' => $state,
            'storageid' => $storageId,
            'systemvmtype' => $systemVmType,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Attempts Migration of a system virtual machine to the host specified.
    *
    * @param string $hostId destination Host ID to migrate VM to
    * @param string $virtualMachineId the ID of the virtual machine
    */
    
    public function migrateSystemVm($hostId, $virtualMachineId) {

        if (empty($hostId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostId"), MISSING_ARGUMENT);
        }

        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }

        return $this->request("migrateSystemVm", array(
            'hostid' => $hostId,
            'virtualmachineid' => $virtualMachineId,
        ));
    }
    
    /**
    * Changes the service offering for a system vm (console proxy or secondary storage). The system vm must be in a "Stopped" state for this command to take effect.
    *
    * @param string $id The ID of the system vm
    * @param string $serviceOfferingId the service offering ID to apply to the system
    *        vm
    * @param string $details name value pairs of custom parameters for cpu, memory and
    *        cpunumber. example details[i].name=value
    */
    
    public function changeServiceForSystemVm($id, $serviceOfferingId, $details = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($serviceOfferingId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceOfferingId"), MISSING_ARGUMENT);
        }

        return $this->request("changeServiceForSystemVm", array(
            'id' => $id,
            'serviceofferingid' => $serviceOfferingId,
            'details' => $details,
        ));
    }
    
    /**
    * Scale the service offering for a system vm (console proxy or secondary storage). The system vm must be in a "Stopped" state for this command to take effect.
    *
    * @param string $id The ID of the system vm
    * @param string $serviceOfferingId the service offering ID to apply to the system
    *        vm
    * @param string $details name value pairs of custom parameters for cpu, memory and
    *        cpunumber. example details[i].name=value
    */
    
    public function scaleSystemVm($id, $serviceOfferingId, $details = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($serviceOfferingId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceOfferingId"), MISSING_ARGUMENT);
        }

        return $this->request("scaleSystemVm", array(
            'id' => $id,
            'serviceofferingid' => $serviceOfferingId,
            'details' => $details,
        ));
    }
    
    /**
    * Creates a ACL rule in the given network (the network has to belong to VPC)
    *
    * @param string $protocol the protocol for the ACL rule. Valid values are
    *        TCP/UDP/ICMP/ALL or valid protocol number
    * @param string $aclId The network of the vm the ACL will be created for
    * @param string $action scl entry action, allow or deny
    * @param string $cidrList the cidr list to allow traffic from/to
    * @param string $endPort the ending port of ACL
    * @param string $icmpCode error code for this icmp message
    * @param string $icmpType type of the icmp message being sent
    * @param string $networkId The network of the vm the ACL will be created for
    * @param string $number The network of the vm the ACL will be created for
    * @param string $startPort the starting port of ACL
    * @param string $trafficType the traffic type for the ACL,can be Ingress or
    *        Egress, defaulted to Ingress if not specified
    */
    
    public function createNetworkACL($protocol, $aclId = "", $action = "", $cidrList = "", $endPort = "", $icmpCode = "", $icmpType = "", $networkId = "", $number = "", $startPort = "", $trafficType = "") {

        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "protocol"), MISSING_ARGUMENT);
        }

        return $this->request("createNetworkACL", array(
            'protocol' => $protocol,
            'aclid' => $aclId,
            'action' => $action,
            'cidrlist' => $cidrList,
            'endport' => $endPort,
            'icmpcode' => $icmpCode,
            'icmptype' => $icmpType,
            'networkid' => $networkId,
            'number' => $number,
            'startport' => $startPort,
            'traffictype' => $trafficType,
        ));
    }
    
    /**
    * Updates ACL Item with specified Id
    *
    * @param string $id the ID of the network ACL Item
    * @param string $action scl entry action, allow or deny
    * @param string $cidrList the cidr list to allow traffic from/to
    * @param string $endPort the ending port of ACL
    * @param string $icmpCode error code for this icmp message
    * @param string $icmpType type of the icmp message being sent
    * @param string $number The network of the vm the ACL will be created for
    * @param string $protocol the protocol for the ACL rule. Valid values are
    *        TCP/UDP/ICMP/ALL or valid protocol number
    * @param string $startPort the starting port of ACL
    * @param string $trafficType the traffic type for the ACL,can be Ingress or
    *        Egress, defaulted to Ingress if not specified
    */
    
    public function updateNetworkACLItem($id, $action = "", $cidrList = "", $endPort = "", $icmpCode = "", $icmpType = "", $number = "", $protocol = "", $startPort = "", $trafficType = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateNetworkACLItem", array(
            'id' => $id,
            'action' => $action,
            'cidrlist' => $cidrList,
            'endport' => $endPort,
            'icmpcode' => $icmpCode,
            'icmptype' => $icmpType,
            'number' => $number,
            'protocol' => $protocol,
            'startport' => $startPort,
            'traffictype' => $trafficType,
        ));
    }
    
    /**
    * Deletes a Network ACL
    *
    * @param string $id the ID of the network ACL
    */
    
    public function deleteNetworkACL($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteNetworkACL", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists all network ACL items
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $aclId list network ACL Items by ACL Id
    * @param string $action list network ACL Items by Action
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id Lists network ACL Item with the specified ID
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $networkId list network ACL Items by network Id
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $protocol list network ACL Items by Protocol
    * @param string $tags List resources by tags (key/value pairs)
    * @param string $trafficType list network ACL Items by traffic type - Ingress or
    *        Egress
    */
    
    public function listNetworkACLs($account = "", $aclId = "", $action = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $networkId = "", $page = "", $pageSize = "", $projectId = "", $protocol = "", $tags = "", $trafficType = "") {

        return $this->request("listNetworkACLs", array(
            'account' => $account,
            'aclid' => $aclId,
            'action' => $action,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'networkid' => $networkId,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'protocol' => $protocol,
            'tags' => $tags,
            'traffictype' => $trafficType,
        ));
    }
    
    /**
    * Creates a Network ACL for the given VPC
    *
    * @param string $name Name of the network ACL List
    * @param string $vpcId Id of the VPC associated with this network ACL List
    * @param string $description Description of the network ACL List
    */
    
    public function createNetworkACLList($name, $vpcId, $description = "") {

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($vpcId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vpcId"), MISSING_ARGUMENT);
        }

        return $this->request("createNetworkACLList", array(
            'name' => $name,
            'vpcid' => $vpcId,
            'description' => $description,
        ));
    }
    
    /**
    * Deletes a Network ACL
    *
    * @param string $id the ID of the network ACL
    */
    
    public function deleteNetworkACLList($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteNetworkACLList", array(
            'id' => $id,
        ));
    }
    
    /**
    * Replaces ACL associated with a Network or private gateway
    *
    * @param string $aclId the ID of the network ACL
    * @param string $gatewayId the ID of the private gateway
    * @param string $networkId the ID of the network
    */
    
    public function replaceNetworkACLList($aclId, $gatewayId = "", $networkId = "") {

        if (empty($aclId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "aclId"), MISSING_ARGUMENT);
        }

        return $this->request("replaceNetworkACLList", array(
            'aclid' => $aclId,
            'gatewayid' => $gatewayId,
            'networkid' => $networkId,
        ));
    }
    
    /**
    * Lists all network ACLs
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id Lists network ACL with the specified ID.
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name list network ACLs by specified name
    * @param string $networkId list network ACLs by network Id
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $vpcId list network ACLs by Vpc Id
    */
    
    public function listNetworkACLLists($account = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $name = "", $networkId = "", $page = "", $pageSize = "", $projectId = "", $vpcId = "") {

        return $this->request("listNetworkACLLists", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'name' => $name,
            'networkid' => $networkId,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'vpcid' => $vpcId,
        ));
    }
    
    /**
    * Creates a security group
    *
    * @param string $name name of the security group
    * @param string $account an optional account for the security group. Must be used
    *        with domainId.
    * @param string $description the description of the security group
    * @param string $domainId an optional domainId for the security group. If the
    *        account parameter is used, domainId must also be used.
    * @param string $projectId Create security group for project
    */
    
    public function createSecurityGroup($name, $account = "", $description = "", $domainId = "", $projectId = "") {

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        return $this->request("createSecurityGroup", array(
            'name' => $name,
            'account' => $account,
            'description' => $description,
            'domainid' => $domainId,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * Deletes security group
    *
    * @param string $account the account of the security group. Must be specified with
    *        domain ID
    * @param string $domainId the domain ID of account owning the security group
    * @param string $id The ID of the security group. Mutually exclusive with name
    *        parameter
    * @param string $name The ID of the security group. Mutually exclusive with id
    *        parameter
    * @param string $projectId the project of the security group
    */
    
    public function deleteSecurityGroup($account = "", $domainId = "", $id = "", $name = "", $projectId = "") {

        return $this->request("deleteSecurityGroup", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'name' => $name,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * Authorizes a particular ingress rule for this security group
    *
    * @param string $account an optional account for the security group. Must be used
    *        with domainId.
    * @param string $cidrList the cidr list associated
    * @param string $domainId an optional domainId for the security group. If the
    *        account parameter is used, domainId must also be used.
    * @param string $endPort end port for this ingress rule
    * @param string $icmpCode error code for this icmp message
    * @param string $icmpType type of the icmp message being sent
    * @param string $projectId an optional project of the security group
    * @param string $protocol TCP is default. UDP is the other supported protocol
    * @param string $securityGroupId The ID of the security group. Mutually exclusive
    *        with securityGroupName parameter
    * @param string $securityGroupName The name of the security group. Mutually
    *        exclusive with securityGroupName parameter
    * @param string $startPort start port for this ingress rule
    * @param string $userSecurityGroupList user to security group mapping
    */
    
    public function authorizeSecurityGroupIngress($account = "", $cidrList = "", $domainId = "", $endPort = "", $icmpCode = "", $icmpType = "", $projectId = "", $protocol = "", $securityGroupId = "", $securityGroupName = "", $startPort = "", $userSecurityGroupList = "") {

        return $this->request("authorizeSecurityGroupIngress", array(
            'account' => $account,
            'cidrlist' => $cidrList,
            'domainid' => $domainId,
            'endport' => $endPort,
            'icmpcode' => $icmpCode,
            'icmptype' => $icmpType,
            'projectid' => $projectId,
            'protocol' => $protocol,
            'securitygroupid' => $securityGroupId,
            'securitygroupname' => $securityGroupName,
            'startport' => $startPort,
            'usersecuritygrouplist' => $userSecurityGroupList,
        ));
    }
    
    /**
    * Deletes a particular ingress rule from this security group
    *
    * @param string $id The ID of the ingress rule
    */
    
    public function revokeSecurityGroupIngress($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("revokeSecurityGroupIngress", array(
            'id' => $id,
        ));
    }
    
    /**
    * Authorizes a particular egress rule for this security group
    *
    * @param string $account an optional account for the security group. Must be used
    *        with domainId.
    * @param string $cidrList the cidr list associated
    * @param string $domainId an optional domainId for the security group. If the
    *        account parameter is used, domainId must also be used.
    * @param string $endPort end port for this egress rule
    * @param string $icmpCode error code for this icmp message
    * @param string $icmpType type of the icmp message being sent
    * @param string $projectId an optional project of the security group
    * @param string $protocol TCP is default. UDP is the other supported protocol
    * @param string $securityGroupId The ID of the security group. Mutually exclusive
    *        with securityGroupName parameter
    * @param string $securityGroupName The name of the security group. Mutually
    *        exclusive with securityGroupName parameter
    * @param string $startPort start port for this egress rule
    * @param string $userSecurityGroupList user to security group mapping
    */
    
    public function authorizeSecurityGroupEgress($account = "", $cidrList = "", $domainId = "", $endPort = "", $icmpCode = "", $icmpType = "", $projectId = "", $protocol = "", $securityGroupId = "", $securityGroupName = "", $startPort = "", $userSecurityGroupList = "") {

        return $this->request("authorizeSecurityGroupEgress", array(
            'account' => $account,
            'cidrlist' => $cidrList,
            'domainid' => $domainId,
            'endport' => $endPort,
            'icmpcode' => $icmpCode,
            'icmptype' => $icmpType,
            'projectid' => $projectId,
            'protocol' => $protocol,
            'securitygroupid' => $securityGroupId,
            'securitygroupname' => $securityGroupName,
            'startport' => $startPort,
            'usersecuritygrouplist' => $userSecurityGroupList,
        ));
    }
    
    /**
    * Deletes a particular egress rule from this security group
    *
    * @param string $id The ID of the egress rule
    */
    
    public function revokeSecurityGroupEgress($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("revokeSecurityGroupEgress", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists security groups
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id list the security group by the id provided
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $securityGroupName lists security groups by name
    * @param string $tags List resources by tags (key/value pairs)
    * @param string $virtualMachineId lists security groups by virtual machine id
    */
    
    public function listSecurityGroups($account = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $projectId = "", $securityGroupName = "", $tags = "", $virtualMachineId = "") {

        return $this->request("listSecurityGroups", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'securitygroupname' => $securityGroupName,
            'tags' => $tags,
            'virtualmachineid' => $virtualMachineId,
        ));
    }
    
    /**
    * Creates a new Pod.
    *
    * @param string $gateway the gateway for the Pod
    * @param string $name the name of the Pod
    * @param string $netmask the netmask for the Pod
    * @param string $startIp the starting IP address for the Pod
    * @param string $zoneId the Zone ID in which the Pod will be created
    * @param string $allocationState Allocation state of this Pod for allocation of
    *        new resources
    * @param string $endIp the ending IP address for the Pod
    */
    
    public function createPod($gateway, $name, $netmask, $startIp, $zoneId, $allocationState = "", $endIp = "") {

        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gateway"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($netmask)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "netmask"), MISSING_ARGUMENT);
        }

        if (empty($startIp)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "startIp"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("createPod", array(
            'gateway' => $gateway,
            'name' => $name,
            'netmask' => $netmask,
            'startip' => $startIp,
            'zoneid' => $zoneId,
            'allocationstate' => $allocationState,
            'endip' => $endIp,
        ));
    }
    
    /**
    * Updates a Pod.
    *
    * @param string $id the ID of the Pod
    * @param string $allocationState Allocation state of this cluster for allocation
    *        of new resources
    * @param string $endIp the ending IP address for the Pod
    * @param string $gateway the gateway for the Pod
    * @param string $name the name of the Pod
    * @param string $netmask the netmask of the Pod
    * @param string $startIp the starting IP address for the Pod
    */
    
    public function updatePod($id, $allocationState = "", $endIp = "", $gateway = "", $name = "", $netmask = "", $startIp = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updatePod", array(
            'id' => $id,
            'allocationstate' => $allocationState,
            'endip' => $endIp,
            'gateway' => $gateway,
            'name' => $name,
            'netmask' => $netmask,
            'startip' => $startIp,
        ));
    }
    
    /**
    * Deletes a Pod.
    *
    * @param string $id the ID of the Pod
    */
    
    public function deletePod($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deletePod", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists all Pods.
    *
    * @param string $allocationState list pods by allocation state
    * @param string $id list Pods by ID
    * @param string $keyword List by keyword
    * @param string $name list Pods by name
    * @param string $page 
    * @param string $pageSize 
    * @param string $showCapacities flag to display the capacity of the pods
    * @param string $zoneId list Pods by Zone ID
    */
    
    public function listPods($allocationState = "", $id = "", $keyword = "", $name = "", $page = "", $pageSize = "", $showCapacities = "", $zoneId = "") {

        return $this->request("listPods", array(
            'allocationstate' => $allocationState,
            'id' => $id,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'showcapacities' => $showCapacities,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Dedicates a Pod.
    *
    * @param string $domainId the ID of the containing domain
    * @param string $podId the ID of the Pod
    * @param string $account the name of the account which needs dedication. Must be
    *        used with domainId.
    */
    
    public function dedicatePod($domainId, $podId, $account = "") {

        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }

        if (empty($podId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "podId"), MISSING_ARGUMENT);
        }

        return $this->request("dedicatePod", array(
            'domainid' => $domainId,
            'podid' => $podId,
            'account' => $account,
        ));
    }
    
    /**
    * Release the dedication for the pod
    *
    * @param string $podId the ID of the Pod
    */
    
    public function releaseDedicatedPod($podId) {

        if (empty($podId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "podId"), MISSING_ARGUMENT);
        }

        return $this->request("releaseDedicatedPod", array(
            'podid' => $podId,
        ));
    }
    
    /**
    * Lists dedicated pods.
    *
    * @param string $account the name of the account associated with the pod. Must be
    *        used with domainId.
    * @param string $affinityGroupId list dedicated pods by affinity group
    * @param string $domainId the ID of the domain associated with the pod
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $podId the ID of the pod
    */
    
    public function listDedicatedPods($account = "", $affinityGroupId = "", $domainId = "", $keyword = "", $page = "", $pageSize = "", $podId = "") {

        return $this->request("listDedicatedPods", array(
            'account' => $account,
            'affinitygroupid' => $affinityGroupId,
            'domainid' => $domainId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'podid' => $podId,
        ));
    }
    
    /**
    * Adds backup image store.
    *
    * @param string $provider the image store provider name
    * @param string $details the details for the image store. Example:
    *        details[0].key=accesskey&amp;amp;details[0].value=s389ddssaa&amp;amp;details[1].
    *        key=secretkey&amp;amp;details[1].value=8dshfsss
    * @param string $name the name for the image store
    * @param string $url the URL for the image store
    * @param string $zoneId the Zone ID for the image store
    */
    
    public function addImageStore($provider, $details = "", $name = "", $url = "", $zoneId = "") {

        if (empty($provider)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "provider"), MISSING_ARGUMENT);
        }

        return $this->request("addImageStore", array(
            'provider' => $provider,
            'details' => $details,
            'name' => $name,
            'url' => $url,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Lists image stores.
    *
    * @param string $id the ID of the storage pool
    * @param string $keyword List by keyword
    * @param string $name the name of the image store
    * @param string $page 
    * @param string $pageSize 
    * @param string $protocol the image store protocol
    * @param string $provider the image store provider
    * @param string $zoneId the Zone ID for the image store
    */
    
    public function listImageStores($id = "", $keyword = "", $name = "", $page = "", $pageSize = "", $protocol = "", $provider = "", $zoneId = "") {

        return $this->request("listImageStores", array(
            'id' => $id,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'protocol' => $protocol,
            'provider' => $provider,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Deletes an image store .
    *
    * @param string $id the image store ID
    */
    
    public function deleteImageStore($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteImageStore", array(
            'id' => $id,
        ));
    }
    
    /**
    * create secondary staging store.
    *
    * @param string $url the URL for the staging store
    * @param string $details the details for the staging store
    * @param string $provider the staging store provider name
    * @param string $scope the scope of the staging store: zone only for now
    * @param string $zoneId the Zone ID for the staging store
    */
    
    public function createSecondaryStagingStore($url, $details = "", $provider = "", $scope = "", $zoneId = "") {

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        return $this->request("createSecondaryStagingStore", array(
            'url' => $url,
            'details' => $details,
            'provider' => $provider,
            'scope' => $scope,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Lists secondary staging stores.
    *
    * @param string $id the ID of the staging store
    * @param string $keyword List by keyword
    * @param string $name the name of the staging store
    * @param string $page 
    * @param string $pageSize 
    * @param string $protocol the staging store protocol
    * @param string $provider the staging store provider
    * @param string $zoneId the Zone ID for the staging store
    */
    
    public function listSecondaryStagingStores($id = "", $keyword = "", $name = "", $page = "", $pageSize = "", $protocol = "", $provider = "", $zoneId = "") {

        return $this->request("listSecondaryStagingStores", array(
            'id' => $id,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'protocol' => $protocol,
            'provider' => $provider,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Deletes a secondary staging store .
    *
    * @param string $id the staging store ID
    */
    
    public function deleteSecondaryStagingStore($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteSecondaryStagingStore", array(
            'id' => $id,
        ));
    }
    
    /**
    * Migrate current NFS secondary storages to use object store.
    *
    * @param string $provider the image store provider name
    * @param string $details the details for the image store. Example:
    *        details[0].key=accesskey&amp;amp;details[0].value=s389ddssaa&amp;amp;details[1].
    *        key=secretkey&amp;amp;details[1].value=8dshfsss
    * @param string $name the name for the image store
    * @param string $url the URL for the image store
    */
    
    public function updateCloudToUseObjectStore($provider, $details = "", $name = "", $url = "") {

        if (empty($provider)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "provider"), MISSING_ARGUMENT);
        }

        return $this->request("updateCloudToUseObjectStore", array(
            'provider' => $provider,
            'details' => $details,
            'name' => $name,
            'url' => $url,
        ));
    }
    
    /**
    * Updates a configuration.
    *
    * @param string $name the name of the configuration
    * @param string $accountId the ID of the Account to update the parameter value for
    *        corresponding account
    * @param string $clusterId the ID of the Cluster to update the parameter value for
    *        corresponding cluster
    * @param string $storageId the ID of the Storage pool to update the parameter
    *        value for corresponding storage pool
    * @param string $value the value of the configuration
    * @param string $zoneId the ID of the Zone to update the parameter value for
    *        corresponding zone
    */
    
    public function updateConfiguration($name, $accountId = "", $clusterId = "", $storageId = "", $value = "", $zoneId = "") {

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        return $this->request("updateConfiguration", array(
            'name' => $name,
            'accountid' => $accountId,
            'clusterid' => $clusterId,
            'storageid' => $storageId,
            'value' => $value,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Lists all configurations.
    *
    * @param string $accountId the ID of the Account to update the parameter value for
    *        corresponding account
    * @param string $category lists configurations by category
    * @param string $clusterId the ID of the Cluster to update the parameter value for
    *        corresponding cluster
    * @param string $keyword List by keyword
    * @param string $name lists configuration by name
    * @param string $page 
    * @param string $pageSize 
    * @param string $storageId the ID of the Storage pool to update the parameter
    *        value for corresponding storage pool
    * @param string $zoneId the ID of the Zone to update the parameter value for
    *        corresponding zone
    */
    
    public function listConfigurations($accountId = "", $category = "", $clusterId = "", $keyword = "", $name = "", $page = "", $pageSize = "", $storageId = "", $zoneId = "") {

        return $this->request("listConfigurations", array(
            'accountid' => $accountId,
            'category' => $category,
            'clusterid' => $clusterId,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'storageid' => $storageId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Lists capabilities
    *
    */
    
    public function listCapabilities() {

        return $this->request("listCapabilities", array(
        ));
    }
    
    /**
    * Lists all DeploymentPlanners available.
    *
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listDeploymentPlanners($keyword = "", $page = "", $pageSize = "") {

        return $this->request("listDeploymentPlanners", array(
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Lists all LDAP configurations
    *
    * @param string $hostname Hostname
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $port Port
    */
    
    public function listLdapConfigurations($hostname = "", $keyword = "", $page = "", $pageSize = "", $port = "") {

        return $this->request("listLdapConfigurations", array(
            'hostname' => $hostname,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'port' => $port,
        ));
    }
    
    /**
    * Add a new Ldap Configuration
    *
    * @param string $hostname Hostname
    * @param string $port Port
    */
    
    public function addLdapConfiguration($hostname, $port) {

        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostname"), MISSING_ARGUMENT);
        }

        if (empty($port)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "port"), MISSING_ARGUMENT);
        }

        return $this->request("addLdapConfiguration", array(
            'hostname' => $hostname,
            'port' => $port,
        ));
    }
    
    /**
    * Remove an Ldap Configuration
    *
    * @param string $hostname Hostname
    */
    
    public function deleteLdapConfiguration($hostname) {

        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostname"), MISSING_ARGUMENT);
        }

        return $this->request("deleteLdapConfiguration", array(
            'hostname' => $hostname,
        ));
    }
    
    /**
    * Adds a new cluster
    *
    * @param string $clusterName the cluster name
    * @param string $clusterType type of the cluster: CloudManaged, ExternalManaged
    * @param string $hypervisor hypervisor type of the cluster:
    *        XenServer,KVM,VMware,Hyperv,BareMetal,Simulator
    * @param string $podId the Pod ID for the host
    * @param string $zoneId the Zone ID for the cluster
    * @param string $allocationState Allocation state of this cluster for allocation
    *        of new resources
    * @param string $guestVswitchName Name of virtual switch used for guest traffic in
    *        the cluster. This would override zone wide traffic label setting.
    * @param string $guestVswitchType Type of virtual switch used for guest traffic in
    *        the cluster. Allowed values are, vmwaresvs (for VMware standard vSwitch) and
    *        vmwaredvs (for VMware distributed vSwitch)
    * @param string $password the password for the host
    * @param string $publicVswitchName Name of virtual switch used for public traffic
    *        in the cluster.  This would override zone wide traffic label setting.
    * @param string $publicVswitchType Type of virtual switch used for public traffic
    *        in the cluster. Allowed values are, vmwaresvs (for VMware standard vSwitch) and
    *        vmwaredvs (for VMware distributed vSwitch)
    * @param string $url the URL
    * @param string $userName the username for the cluster
    * @param string $vsmIpAddress the ipaddress of the VSM associated with this
    *        cluster
    * @param string $vsmPassword the password for the VSM associated with this
    *        cluster
    * @param string $vsmUsername the username for the VSM associated with this
    *        cluster
    */
    
    public function addCluster($clusterName, $clusterType, $hypervisor, $podId, $zoneId, $allocationState = "", $guestVswitchName = "", $guestVswitchType = "", $password = "", $publicVswitchName = "", $publicVswitchType = "", $url = "", $userName = "", $vsmIpAddress = "", $vsmPassword = "", $vsmUsername = "") {

        if (empty($clusterName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "clusterName"), MISSING_ARGUMENT);
        }

        if (empty($clusterType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "clusterType"), MISSING_ARGUMENT);
        }

        if (empty($hypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hypervisor"), MISSING_ARGUMENT);
        }

        if (empty($podId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "podId"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("addCluster", array(
            'clustername' => $clusterName,
            'clustertype' => $clusterType,
            'hypervisor' => $hypervisor,
            'podid' => $podId,
            'zoneid' => $zoneId,
            'allocationstate' => $allocationState,
            'guestvswitchname' => $guestVswitchName,
            'guestvswitchtype' => $guestVswitchType,
            'password' => $password,
            'publicvswitchname' => $publicVswitchName,
            'publicvswitchtype' => $publicVswitchType,
            'url' => $url,
            'username' => $userName,
            'vsmipaddress' => $vsmIpAddress,
            'vsmpassword' => $vsmPassword,
            'vsmusername' => $vsmUsername,
        ));
    }
    
    /**
    * Deletes a cluster.
    *
    * @param string $id the cluster ID
    */
    
    public function deleteCluster($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteCluster", array(
            'id' => $id,
        ));
    }
    
    /**
    * Updates an existing cluster
    *
    * @param string $id the ID of the Cluster
    * @param string $allocationState Allocation state of this cluster for allocation
    *        of new resources
    * @param string $clusterName the cluster name
    * @param string $clusterType hypervisor type of the cluster
    * @param string $hypervisor hypervisor type of the cluster
    * @param string $managedState whether this cluster is managed by cloudstack
    */
    
    public function updateCluster($id, $allocationState = "", $clusterName = "", $clusterType = "", $hypervisor = "", $managedState = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateCluster", array(
            'id' => $id,
            'allocationstate' => $allocationState,
            'clustername' => $clusterName,
            'clustertype' => $clusterType,
            'hypervisor' => $hypervisor,
            'managedstate' => $managedState,
        ));
    }
    
    /**
    * Lists clusters.
    *
    * @param string $allocationState lists clusters by allocation state
    * @param string $clusterType lists clusters by cluster type
    * @param string $hypervisor lists clusters by hypervisor type
    * @param string $id lists clusters by the cluster ID
    * @param string $keyword List by keyword
    * @param string $managedState whether this cluster is managed by cloudstack
    * @param string $name lists clusters by the cluster name
    * @param string $page 
    * @param string $pageSize 
    * @param string $podId lists clusters by Pod ID
    * @param string $showCapacities flag to display the capacity of the clusters
    * @param string $zoneId lists clusters by Zone ID
    */
    
    public function listClusters($allocationState = "", $clusterType = "", $hypervisor = "", $id = "", $keyword = "", $managedState = "", $name = "", $page = "", $pageSize = "", $podId = "", $showCapacities = "", $zoneId = "") {

        return $this->request("listClusters", array(
            'allocationstate' => $allocationState,
            'clustertype' => $clusterType,
            'hypervisor' => $hypervisor,
            'id' => $id,
            'keyword' => $keyword,
            'managedstate' => $managedState,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'podid' => $podId,
            'showcapacities' => $showCapacities,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Dedicate an existing cluster
    *
    * @param string $clusterId the ID of the Cluster
    * @param string $domainId the ID of the containing domain
    * @param string $account the name of the account which needs dedication. Must be
    *        used with domainId.
    */
    
    public function dedicateCluster($clusterId, $domainId, $account = "") {

        if (empty($clusterId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "clusterId"), MISSING_ARGUMENT);
        }

        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }

        return $this->request("dedicateCluster", array(
            'clusterid' => $clusterId,
            'domainid' => $domainId,
            'account' => $account,
        ));
    }
    
    /**
    * Release the dedication for cluster
    *
    * @param string $clusterId the ID of the Cluster
    */
    
    public function releaseDedicatedCluster($clusterId) {

        if (empty($clusterId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "clusterId"), MISSING_ARGUMENT);
        }

        return $this->request("releaseDedicatedCluster", array(
            'clusterid' => $clusterId,
        ));
    }
    
    /**
    * Lists dedicated clusters.
    *
    * @param string $account the name of the account associated with the cluster. Must
    *        be used with domainId.
    * @param string $affinityGroupId list dedicated clusters by affinity group
    * @param string $clusterId the ID of the cluster
    * @param string $domainId the ID of the domain associated with the cluster
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listDedicatedClusters($account = "", $affinityGroupId = "", $clusterId = "", $domainId = "", $keyword = "", $page = "", $pageSize = "") {

        return $this->request("listDedicatedClusters", array(
            'account' => $account,
            'affinitygroupid' => $affinityGroupId,
            'clusterid' => $clusterId,
            'domainid' => $domainId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Creates a VLAN IP range.
    *
    * @param string $account account who will own the VLAN. If VLAN is Zone wide, this
    *        parameter should be ommited
    * @param string $domainId domain ID of the account owning a VLAN
    * @param string $endIp the ending IP address in the VLAN IP range
    * @param string $endIpv6 the ending IPv6 address in the IPv6 network range
    * @param string $forVirtualNetwork true if VLAN is of Virtual type, false if
    *        Direct
    * @param string $gateway the gateway of the VLAN IP range
    * @param string $ip6Cidr the CIDR of IPv6 network, must be at least /64
    * @param string $ip6Gateway the gateway of the IPv6 network. Required for Shared
    *        networks and Isolated networks when it belongs to VPC
    * @param string $netmask the netmask of the VLAN IP range
    * @param string $networkId the network id
    * @param string $physicalNetworkId the physical network id
    * @param string $podId optional parameter. Have to be specified for Direct
    *        Untagged vlan only.
    * @param string $projectId project who will own the VLAN. If VLAN is Zone wide,
    *        this parameter should be ommited
    * @param string $startIp the beginning IP address in the VLAN IP range
    * @param string $startIpv6 the beginning IPv6 address in the IPv6 network range
    * @param string $vlan the ID or VID of the VLAN. If not specified, will be
    *        defaulted to the vlan of the network or if vlan of the network is null - to
    *        Untagged
    * @param string $zoneId the Zone ID of the VLAN IP range
    */
    
    public function createVlanIpRange($account = "", $domainId = "", $endIp = "", $endIpv6 = "", $forVirtualNetwork = "", $gateway = "", $ip6Cidr = "", $ip6Gateway = "", $netmask = "", $networkId = "", $physicalNetworkId = "", $podId = "", $projectId = "", $startIp = "", $startIpv6 = "", $vlan = "", $zoneId = "") {

        return $this->request("createVlanIpRange", array(
            'account' => $account,
            'domainid' => $domainId,
            'endip' => $endIp,
            'endipv6' => $endIpv6,
            'forvirtualnetwork' => $forVirtualNetwork,
            'gateway' => $gateway,
            'ip6cidr' => $ip6Cidr,
            'ip6gateway' => $ip6Gateway,
            'netmask' => $netmask,
            'networkid' => $networkId,
            'physicalnetworkid' => $physicalNetworkId,
            'podid' => $podId,
            'projectid' => $projectId,
            'startip' => $startIp,
            'startipv6' => $startIpv6,
            'vlan' => $vlan,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Creates a VLAN IP range.
    *
    * @param string $id the id of the VLAN IP range
    */
    
    public function deleteVlanIpRange($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteVlanIpRange", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists all VLAN IP ranges.
    *
    * @param string $account the account with which the VLAN IP range is associated.
    *        Must be used with the domainId parameter.
    * @param string $domainId the domain ID with which the VLAN IP range is
    *        associated.  If used with the account parameter, returns all VLAN IP ranges for
    *        that account in the specified domain.
    * @param string $forVirtualNetwork true if VLAN is of Virtual type, false if
    *        Direct
    * @param string $id the ID of the VLAN IP range
    * @param string $keyword List by keyword
    * @param string $networkId network id of the VLAN IP range
    * @param string $page 
    * @param string $pageSize 
    * @param string $physicalNetworkId physical network id of the VLAN IP range
    * @param string $podId the Pod ID of the VLAN IP range
    * @param string $projectId project who will own the VLAN
    * @param string $vlan the ID or VID of the VLAN. Default is an
    *        &quot;untagged&quot; VLAN.
    * @param string $zoneId the Zone ID of the VLAN IP range
    */
    
    public function listVlanIpRanges($account = "", $domainId = "", $forVirtualNetwork = "", $id = "", $keyword = "", $networkId = "", $page = "", $pageSize = "", $physicalNetworkId = "", $podId = "", $projectId = "", $vlan = "", $zoneId = "") {

        return $this->request("listVlanIpRanges", array(
            'account' => $account,
            'domainid' => $domainId,
            'forvirtualnetwork' => $forVirtualNetwork,
            'id' => $id,
            'keyword' => $keyword,
            'networkid' => $networkId,
            'page' => $page,
            'pagesize' => $pageSize,
            'physicalnetworkid' => $physicalNetworkId,
            'podid' => $podId,
            'projectid' => $projectId,
            'vlan' => $vlan,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Dedicates a guest vlan range to an account
    *
    * @param string $account account who will own the VLAN
    * @param string $domainId domain ID of the account owning a VLAN
    * @param string $physicalNetworkId physical network ID of the vlan
    * @param string $vlanRange guest vlan range to be dedicated
    * @param string $projectId project who will own the VLAN
    */
    
    public function dedicateGuestVlanRange($account, $domainId, $physicalNetworkId, $vlanRange, $projectId = "") {

        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }

        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }

        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }

        if (empty($vlanRange)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vlanRange"), MISSING_ARGUMENT);
        }

        return $this->request("dedicateGuestVlanRange", array(
            'account' => $account,
            'domainid' => $domainId,
            'physicalnetworkid' => $physicalNetworkId,
            'vlanrange' => $vlanRange,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * Releases a dedicated guest vlan range to the system
    *
    * @param string $id the ID of the dedicated guest vlan range
    */
    
    public function releaseDedicatedGuestVlanRange($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("releaseDedicatedGuestVlanRange", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists dedicated guest vlan ranges
    *
    * @param string $account the account with which the guest VLAN range is
    *        associated. Must be used with the domainId parameter.
    * @param string $domainId the domain ID with which the guest VLAN range is
    *        associated.  If used with the account parameter, returns all guest VLAN ranges
    *        for that account in the specified domain.
    * @param string $guestVlanRange the dedicated guest vlan range
    * @param string $id list dedicated guest vlan ranges by id
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $physicalNetworkId physical network id of the guest VLAN range
    * @param string $projectId project who will own the guest VLAN range
    * @param string $zoneId zone of the guest VLAN range
    */
    
    public function listDedicatedGuestVlanRanges($account = "", $domainId = "", $guestVlanRange = "", $id = "", $keyword = "", $page = "", $pageSize = "", $physicalNetworkId = "", $projectId = "", $zoneId = "") {

        return $this->request("listDedicatedGuestVlanRanges", array(
            'account' => $account,
            'domainid' => $domainId,
            'guestvlanrange' => $guestVlanRange,
            'id' => $id,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'physicalnetworkid' => $physicalNetworkId,
            'projectid' => $projectId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Configures an Internal Load Balancer element.
    *
    * @param string $id the ID of the internal lb provider
    * @param string $enabled Enables/Disables the Internal Load Balancer element
    */
    
    public function configureInternalLoadBalancerElement($id, $enabled) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($enabled)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "enabled"), MISSING_ARGUMENT);
        }

        return $this->request("configureInternalLoadBalancerElement", array(
            'id' => $id,
            'enabled' => $enabled,
        ));
    }
    
    /**
    * Create an Internal Load Balancer element.
    *
    * @param string $nspId the network service provider ID of the internal load
    *        balancer element
    */
    
    public function createInternalLoadBalancerElement($nspId) {

        if (empty($nspId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nspId"), MISSING_ARGUMENT);
        }

        return $this->request("createInternalLoadBalancerElement", array(
            'nspid' => $nspId,
        ));
    }
    
    /**
    * Lists all available Internal Load Balancer elements.
    *
    * @param string $enabled list internal load balancer elements by enabled state
    * @param string $id list internal load balancer elements by id
    * @param string $keyword List by keyword
    * @param string $nspId list internal load balancer elements by network service
    *        provider id
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listInternalLoadBalancerElements($enabled = "", $id = "", $keyword = "", $nspId = "", $page = "", $pageSize = "") {

        return $this->request("listInternalLoadBalancerElements", array(
            'enabled' => $enabled,
            'id' => $id,
            'keyword' => $keyword,
            'nspid' => $nspId,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Stops an Internal LB vm.
    *
    * @param string $id the ID of the internal lb vm
    * @param string $forced Force stop the VM. The caller knows the VM is stopped.
    */
    
    public function stopInternalLoadBalancerVM($id, $forced = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("stopInternalLoadBalancerVM", array(
            'id' => $id,
            'forced' => $forced,
        ));
    }
    
    /**
    * Starts an existing internal lb vm.
    *
    * @param string $id the ID of the internal lb vm
    */
    
    public function startInternalLoadBalancerVM($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("startInternalLoadBalancerVM", array(
            'id' => $id,
        ));
    }
    
    /**
    * List internal LB VMs.
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $forVpc if true is passed for this parameter, list only VPC
    *        Internal LB VMs
    * @param string $hostId the host ID of the Internal LB VM
    * @param string $id the ID of the Internal LB VM
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name the name of the Internal LB VM
    * @param string $networkId list by network id
    * @param string $page 
    * @param string $pageSize 
    * @param string $podId the Pod ID of the Internal LB VM
    * @param string $projectId list objects by project
    * @param string $state the state of the Internal LB VM
    * @param string $vpcId List Internal LB VMs by VPC
    * @param string $zoneId the Zone ID of the Internal LB VM
    */
    
    public function listInternalLoadBalancerVMs($account = "", $domainId = "", $forVpc = "", $hostId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $name = "", $networkId = "", $page = "", $pageSize = "", $podId = "", $projectId = "", $state = "", $vpcId = "", $zoneId = "") {

        return $this->request("listInternalLoadBalancerVMs", array(
            'account' => $account,
            'domainid' => $domainId,
            'forvpc' => $forVpc,
            'hostid' => $hostId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'name' => $name,
            'networkid' => $networkId,
            'page' => $page,
            'pagesize' => $pageSize,
            'podid' => $podId,
            'projectid' => $projectId,
            'state' => $state,
            'vpcid' => $vpcId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Create a LUN from a pool
    *
    * @param string $name pool name.
    * @param string $size LUN size.
    */
    
    public function createLunOnFiler($name, $size) {

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($size)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "size"), MISSING_ARGUMENT);
        }

        return $this->request("createLunOnFiler", array(
            'name' => $name,
            'size' => $size,
        ));
    }
    
    /**
    * Destroy a LUN
    *
    * @param string $path LUN path.
    */
    
    public function destroyLunOnFiler($path) {

        if (empty($path)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "path"), MISSING_ARGUMENT);
        }

        return $this->request("destroyLunOnFiler", array(
            'path' => $path,
        ));
    }
    
    /**
    * List LUN
    *
    * @param string $poolName pool name.
    */
    
    public function listLunsOnFiler($poolName) {

        if (empty($poolName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "poolName"), MISSING_ARGUMENT);
        }

        return $this->request("listLunsOnFiler", array(
            'poolname' => $poolName,
        ));
    }
    
    /**
    * Associate a LUN with a guest IQN
    *
    * @param string $iqn Guest IQN to which the LUN associate.
    * @param string $name LUN name.
    */
    
    public function associateLun($iqn, $name) {

        if (empty($iqn)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "iqn"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        return $this->request("associateLun", array(
            'iqn' => $iqn,
            'name' => $name,
        ));
    }
    
    /**
    * Dissociate a LUN
    *
    * @param string $iqn Guest IQN.
    * @param string $path LUN path.
    */
    
    public function dissociateLun($iqn, $path) {

        if (empty($iqn)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "iqn"), MISSING_ARGUMENT);
        }

        if (empty($path)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "path"), MISSING_ARGUMENT);
        }

        return $this->request("dissociateLun", array(
            'iqn' => $iqn,
            'path' => $path,
        ));
    }
    
    /**
    * Resets the SSH Key for virtual machine. The virtual machine must be in a "Stopped" state. [async]
    *
    * @param string $id The ID of the virtual machine
    * @param string $keyPair name of the ssh key pair used to login to the virtual
    *        machine
    * @param string $account an optional account for the ssh key. Must be used with
    *        domainId.
    * @param string $domainId an optional domainId for the virtual machine. If the
    *        account parameter is used, domainId must also be used.
    * @param string $projectId an optional project for the ssh key
    */
    
    public function resetSSHKeyForVirtualMachine($id, $keyPair, $account = "", $domainId = "", $projectId = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($keyPair)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "keyPair"), MISSING_ARGUMENT);
        }

        return $this->request("resetSSHKeyForVirtualMachine", array(
            'id' => $id,
            'keypair' => $keyPair,
            'account' => $account,
            'domainid' => $domainId,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * Register a public key in a keypair under a certain name
    *
    * @param string $name Name of the keypair
    * @param string $publicKey Public key material of the keypair
    * @param string $account an optional account for the ssh key. Must be used with
    *        domainId.
    * @param string $domainId an optional domainId for the ssh key. If the account
    *        parameter is used, domainId must also be used.
    * @param string $projectId an optional project for the ssh key
    */
    
    public function registerSSHKeyPair($name, $publicKey, $account = "", $domainId = "", $projectId = "") {

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($publicKey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "publicKey"), MISSING_ARGUMENT);
        }

        return $this->request("registerSSHKeyPair", array(
            'name' => $name,
            'publickey' => $publicKey,
            'account' => $account,
            'domainid' => $domainId,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * Create a new keypair and returns the private key
    *
    * @param string $name Name of the keypair
    * @param string $account an optional account for the ssh key. Must be used with
    *        domainId.
    * @param string $domainId an optional domainId for the ssh key. If the account
    *        parameter is used, domainId must also be used.
    * @param string $projectId an optional project for the ssh key
    */
    
    public function createSSHKeyPair($name, $account = "", $domainId = "", $projectId = "") {

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        return $this->request("createSSHKeyPair", array(
            'name' => $name,
            'account' => $account,
            'domainid' => $domainId,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * Deletes a keypair by name
    *
    * @param string $name Name of the keypair
    * @param string $account the account associated with the keypair. Must be used
    *        with the domainId parameter.
    * @param string $domainId the domain ID associated with the keypair
    * @param string $projectId the project associated with keypair
    */
    
    public function deleteSSHKeyPair($name, $account = "", $domainId = "", $projectId = "") {

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        return $this->request("deleteSSHKeyPair", array(
            'name' => $name,
            'account' => $account,
            'domainid' => $domainId,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * List registered keypairs
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $fingerprint A public key fingerprint to look for
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name A key pair name to look for
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    */
    
    public function listSSHKeyPairs($account = "", $domainId = "", $fingerprint = "", $isRecursive = "", $keyword = "", $listAll = "", $name = "", $page = "", $pageSize = "", $projectId = "") {

        return $this->request("listSSHKeyPairs", array(
            'account' => $account,
            'domainid' => $domainId,
            'fingerprint' => $fingerprint,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * Enables static nat for given ip address
    *
    * @param string $ipAddressId the public IP address id for which static nat feature
    *        is being enabled
    * @param string $virtualMachineId the ID of the virtual machine for enabling
    *        static nat feature
    * @param string $networkId The network of the vm the static nat will be enabled
    *        for. Required when public Ip address is not associated with any Guest network
    *        yet (VPC case)
    * @param string $vmGuestIp VM guest nic Secondary ip address for the port
    *        forwarding rule
    */
    
    public function enableStaticNat($ipAddressId, $virtualMachineId, $networkId = "", $vmGuestIp = "") {

        if (empty($ipAddressId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipAddressId"), MISSING_ARGUMENT);
        }

        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }

        return $this->request("enableStaticNat", array(
            'ipaddressid' => $ipAddressId,
            'virtualmachineid' => $virtualMachineId,
            'networkid' => $networkId,
            'vmguestip' => $vmGuestIp,
        ));
    }
    
    /**
    * Creates an ip forwarding rule
    *
    * @param string $ipAddressId the public IP address id of the forwarding rule,
    *        already associated via associateIp
    * @param string $protocol the protocol for the rule. Valid values are TCP or UDP.
    * @param string $startPort the start port for the rule
    * @param string $cidrList the cidr list to forward traffic from
    * @param string $endPort the end port for the rule
    * @param string $openFirewall if true, firewall rule for source/end pubic port is
    *        automatically created; if false - firewall rule has to be created explicitely.
    *        Has value true by default
    */
    
    public function createIpForwardingRule($ipAddressId, $protocol, $startPort, $cidrList = "", $endPort = "", $openFirewall = "") {

        if (empty($ipAddressId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipAddressId"), MISSING_ARGUMENT);
        }

        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "protocol"), MISSING_ARGUMENT);
        }

        if (empty($startPort)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "startPort"), MISSING_ARGUMENT);
        }

        return $this->request("createIpForwardingRule", array(
            'ipaddressid' => $ipAddressId,
            'protocol' => $protocol,
            'startport' => $startPort,
            'cidrlist' => $cidrList,
            'endport' => $endPort,
            'openfirewall' => $openFirewall,
        ));
    }
    
    /**
    * Deletes an ip forwarding rule
    *
    * @param string $id the id of the forwarding rule
    */
    
    public function deleteIpForwardingRule($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteIpForwardingRule", array(
            'id' => $id,
        ));
    }
    
    /**
    * List the ip forwarding rules
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id Lists rule with the specified ID.
    * @param string $ipAddressId list the rule belonging to this public ip address
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $virtualMachineId Lists all rules applied to the specified Vm.
    */
    
    public function listIpForwardingRules($account = "", $domainId = "", $id = "", $ipAddressId = "", $isRecursive = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $projectId = "", $virtualMachineId = "") {

        return $this->request("listIpForwardingRules", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'ipaddressid' => $ipAddressId,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'virtualmachineid' => $virtualMachineId,
        ));
    }
    
    /**
    * Disables static rule for given ip address
    *
    * @param string $ipAddressId the public IP address id for which static nat feature
    *        is being disableed
    */
    
    public function disableStaticNat($ipAddressId) {

        if (empty($ipAddressId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipAddressId"), MISSING_ARGUMENT);
        }

        return $this->request("disableStaticNat", array(
            'ipaddressid' => $ipAddressId,
        ));
    }
    
    /**
    * Updates resource limits for an account or domain.
    *
    * @param string $resourceType Type of resource to update. Values are 0, 1, 2, 3,
    *        4, 6, 7, 8, 9, 10 and 11. 0 - Instance. Number of instances a user can create. 1
    *        - IP. Number of public IP addresses a user can own. 2 - Volume. Number of disk
    *        volumes a user can create.3 - Snapshot. Number of snapshots a user can create.4
    *        - Template. Number of templates that a user can register/create.6 - Network.
    *        Number of guest network a user can create.7 - VPC. Number of VPC a user can
    *        create.8 - CPU. Total number of CPU cores a user can use.9 - Memory. Total
    *        Memory (in MB) a user can use.10 - PrimaryStorage. Total primary storage space
    *        (in GiB) a user can use.11 - SecondaryStorage. Total secondary storage space (in
    *        GiB) a user can use.
    * @param string $account Update resource for a specified account. Must be used
    *        with the domainId parameter.
    * @param string $domainId Update resource limits for all accounts in specified
    *        domain. If used with the account parameter, updates resource limits for a
    *        specified account in specified domain.
    * @param string $max Maximum resource limit.
    * @param string $projectId Update resource limits for project
    */
    
    public function updateResourceLimit($resourceType, $account = "", $domainId = "", $max = "", $projectId = "") {

        if (empty($resourceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceType"), MISSING_ARGUMENT);
        }

        return $this->request("updateResourceLimit", array(
            'resourcetype' => $resourceType,
            'account' => $account,
            'domainid' => $domainId,
            'max' => $max,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * Recalculate and update resource count for an account or domain.
    *
    * @param string $domainId If account parameter specified then updates resource
    *        counts for a specified account in this domain else update resource counts for
    *        all accounts &amp;amp; child domains in specified domain.
    * @param string $account Update resource count for a specified account. Must be
    *        used with the domainId parameter.
    * @param string $projectId Update resource limits for project
    * @param string $resourceType Type of resource to update. If specifies valid
    *        values are 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 and 11. If not specified will update
    *        all resource counts0 - Instance. Number of instances a user can create. 1 - IP.
    *        Number of public IP addresses a user can own. 2 - Volume. Number of disk volumes
    *        a user can create.3 - Snapshot. Number of snapshots a user can create.4 -
    *        Template. Number of templates that a user can register/create.5 - Project.
    *        Number of projects that a user can create.6 - Network. Number of guest network a
    *        user can create.7 - VPC. Number of VPC a user can create.8 - CPU. Total number
    *        of CPU cores a user can use.9 - Memory. Total Memory (in MB) a user can use.10 -
    *        PrimaryStorage. Total primary storage space (in GiB) a user can use.11 -
    *        SecondaryStorage. Total secondary storage space (in GiB) a user can use.
    */
    
    public function updateResourceCount($domainId, $account = "", $projectId = "", $resourceType = "") {

        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }

        return $this->request("updateResourceCount", array(
            'domainid' => $domainId,
            'account' => $account,
            'projectid' => $projectId,
            'resourcetype' => $resourceType,
        ));
    }
    
    /**
    * Lists resource limits.
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id Lists resource limits by ID.
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $resourceType Type of resource to update. Values are 0, 1, 2, 3,
    *        and 4.0 - Instance. Number of instances a user can create. 1 - IP. Number of
    *        public IP addresses an account can own. 2 - Volume. Number of disk volumes an
    *        account can own.3 - Snapshot. Number of snapshots an account can own.4 -
    *        Template. Number of templates an account can register/create.5 - Project. Number
    *        of projects an account can own.6 - Network. Number of networks an account can
    *        own.7 - VPC. Number of VPC an account can own.8 - CPU. Number of CPU an account
    *        can allocate for his resources.9 - Memory. Amount of RAM an account can allocate
    *        for his resources.10 - Primary Storage. Amount of Primary storage an account can
    *        allocate for his resoruces.11 - Secondary Storage. Amount of Secondary storage
    *        an account can allocate for his resources.
    */
    
    public function listResourceLimits($account = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $projectId = "", $resourceType = "") {

        return $this->request("listResourceLimits", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'resourcetype' => $resourceType,
        ));
    }
    
    /**
    * Get API limit count for the caller
    *
    */
    
    public function getApiLimit() {

        return $this->request("getApiLimit", array(
        ));
    }
    
    /**
    * Reset api count
    *
    * @param string $account the ID of the acount whose limit to be reset
    */
    
    public function resetApiLimit($account = "") {

        return $this->request("resetApiLimit", array(
            'account' => $account,
        ));
    }
    
    /**
    * Creates a domain
    *
    * @param string $name creates domain with this name
    * @param string $domainId Domain UUID, required for adding domain from another
    *        Region
    * @param string $networkDomain Network domain for networks in the domain
    * @param string $parentDomainId assigns new domain a parent domain by domain ID of
    *        the parent.  If no parent domain is specied, the ROOT domain is assumed.
    */
    
    public function createDomain($name, $domainId = "", $networkDomain = "", $parentDomainId = "") {

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        return $this->request("createDomain", array(
            'name' => $name,
            'domainid' => $domainId,
            'networkdomain' => $networkDomain,
            'parentdomainid' => $parentDomainId,
        ));
    }
    
    /**
    * Updates a domain with a new name
    *
    * @param string $id ID of domain to update
    * @param string $name updates domain with this name
    * @param string $networkDomain Network domain for the domain&#039;s networks;
    *        empty string will update domainName with NULL value
    */
    
    public function updateDomain($id, $name = "", $networkDomain = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateDomain", array(
            'id' => $id,
            'name' => $name,
            'networkdomain' => $networkDomain,
        ));
    }
    
    /**
    * Deletes a specified domain
    *
    * @param string $id ID of domain to delete
    * @param string $cleanup true if all domain resources (child domains, accounts)
    *        have to be cleaned up, false otherwise
    */
    
    public function deleteDomain($id, $cleanup = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteDomain", array(
            'id' => $id,
            'cleanup' => $cleanup,
        ));
    }
    
    /**
    * Lists domains and provides detailed information for listed domains
    *
    * @param string $id List domain by domain ID.
    * @param string $keyword List by keyword
    * @param string $level List domains by domain level.
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name List domain by domain name.
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listDomains($id = "", $keyword = "", $level = "", $listAll = "", $name = "", $page = "", $pageSize = "") {

        return $this->request("listDomains", array(
            'id' => $id,
            'keyword' => $keyword,
            'level' => $level,
            'listall' => $listAll,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Lists all children domains belonging to a specified domain
    *
    * @param string $id list children domain by parent domain ID.
    * @param string $isRecursive to return the entire tree, use the value
    *        &quot;true&quot;. To return the first level children, use the value
    *        &quot;false&quot;.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name list children domains by name
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listDomainChildren($id = "", $isRecursive = "", $keyword = "", $listAll = "", $name = "", $page = "", $pageSize = "") {

        return $this->request("listDomainChildren", array(
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * add a baremetal pxe server
    *
    * @param string $password Credentials to reach external pxe device
    * @param string $physicalNetworkId the Physical Network ID
    * @param string $pxeServerType type of pxe device
    * @param string $tftpDir Tftp root directory of PXE server
    * @param string $url URL of the external pxe device
    * @param string $userName Credentials to reach external pxe device
    * @param string $podId Pod Id
    */
    
    public function addBaremetalPxeKickStartServer($password, $physicalNetworkId, $pxeServerType, $tftpDir, $url, $userName, $podId = "") {

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }

        if (empty($pxeServerType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "pxeServerType"), MISSING_ARGUMENT);
        }

        if (empty($tftpDir)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "tftpDir"), MISSING_ARGUMENT);
        }

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        return $this->request("addBaremetalPxeKickStartServer", array(
            'password' => $password,
            'physicalnetworkid' => $physicalNetworkId,
            'pxeservertype' => $pxeServerType,
            'tftpdir' => $tftpDir,
            'url' => $url,
            'username' => $userName,
            'podid' => $podId,
        ));
    }
    
    /**
    * add a baremetal ping pxe server
    *
    * @param string $password Credentials to reach external pxe device
    * @param string $physicalNetworkId the Physical Network ID
    * @param string $pingDir Root directory on PING storage server
    * @param string $pingStorageServerIp PING storage server ip
    * @param string $pxeServerType type of pxe device
    * @param string $tftpDir Tftp root directory of PXE server
    * @param string $url URL of the external pxe device
    * @param string $userName Credentials to reach external pxe device
    * @param string $pingCifsPassword Password of PING storage server
    * @param string $pingCifsUsername Username of PING storage server
    * @param string $podId Pod Id
    */
    
    public function addBaremetalPxePingServer($password, $physicalNetworkId, $pingDir, $pingStorageServerIp, $pxeServerType, $tftpDir, $url, $userName, $pingCifsPassword = "", $pingCifsUsername = "", $podId = "") {

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }

        if (empty($pingDir)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "pingDir"), MISSING_ARGUMENT);
        }

        if (empty($pingStorageServerIp)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "pingStorageServerIp"), MISSING_ARGUMENT);
        }

        if (empty($pxeServerType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "pxeServerType"), MISSING_ARGUMENT);
        }

        if (empty($tftpDir)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "tftpDir"), MISSING_ARGUMENT);
        }

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        return $this->request("addBaremetalPxePingServer", array(
            'password' => $password,
            'physicalnetworkid' => $physicalNetworkId,
            'pingdir' => $pingDir,
            'pingstorageserverip' => $pingStorageServerIp,
            'pxeservertype' => $pxeServerType,
            'tftpdir' => $tftpDir,
            'url' => $url,
            'username' => $userName,
            'pingcifspassword' => $pingCifsPassword,
            'pingcifsusername' => $pingCifsUsername,
            'podid' => $podId,
        ));
    }
    
    /**
    * adds a baremetal dhcp server
    *
    * @param string $dhcpServerType Type of dhcp device
    * @param string $password Credentials to reach external dhcp device
    * @param string $physicalNetworkId the Physical Network ID
    * @param string $url URL of the external dhcp appliance.
    * @param string $userName Credentials to reach external dhcp device
    */
    
    public function addBaremetalDhcp($dhcpServerType, $password, $physicalNetworkId, $url, $userName) {

        if (empty($dhcpServerType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "dhcpServerType"), MISSING_ARGUMENT);
        }

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        return $this->request("addBaremetalDhcp", array(
            'dhcpservertype' => $dhcpServerType,
            'password' => $password,
            'physicalnetworkid' => $physicalNetworkId,
            'url' => $url,
            'username' => $userName,
        ));
    }
    
    /**
    * list baremetal dhcp servers
    *
    * @param string $dhcpServerType Type of DHCP device
    * @param string $id DHCP server device ID
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listBaremetalDhcp($dhcpServerType = "", $id = "", $keyword = "", $page = "", $pageSize = "") {

        return $this->request("listBaremetalDhcp", array(
            'dhcpservertype' => $dhcpServerType,
            'id' => $id,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * list baremetal pxe server
    *
    * @param string $id Pxe server device ID
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listBaremetalPxeServers($id = "", $keyword = "", $page = "", $pageSize = "") {

        return $this->request("listBaremetalPxeServers", array(
            'id' => $id,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Creates an affinity/anti-affinity group
    *
    * @param string $name name of the affinity group
    * @param string $type Type of the affinity group from the available
    *        affinity/anti-affinity group types
    * @param string $account an account for the affinity group. Must be used with
    *        domainId.
    * @param string $description optional description of the affinity group
    * @param string $domainId domainId of the account owning the affinity group
    */
    
    public function createAffinityGroup($name, $type, $account = "", $description = "", $domainId = "") {

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($type)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "type"), MISSING_ARGUMENT);
        }

        return $this->request("createAffinityGroup", array(
            'name' => $name,
            'type' => $type,
            'account' => $account,
            'description' => $description,
            'domainid' => $domainId,
        ));
    }
    
    /**
    * Deletes affinity group
    *
    * @param string $account the account of the affinity group. Must be specified with
    *        domain ID
    * @param string $domainId the domain ID of account owning the affinity group
    * @param string $id The ID of the affinity group. Mutually exclusive with name
    *        parameter
    * @param string $name The name of the affinity group. Mutually exclusive with id
    *        parameter
    */
    
    public function deleteAffinityGroup($account = "", $domainId = "", $id = "", $name = "") {

        return $this->request("deleteAffinityGroup", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'name' => $name,
        ));
    }
    
    /**
    * Lists affinity groups
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id list the affinity group by the id provided
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name lists affinity groups by name
    * @param string $page 
    * @param string $pageSize 
    * @param string $type lists affinity groups by type
    * @param string $virtualMachineId lists affinity groups by virtual machine id
    */
    
    public function listAffinityGroups($account = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $name = "", $page = "", $pageSize = "", $type = "", $virtualMachineId = "") {

        return $this->request("listAffinityGroups", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'type' => $type,
            'virtualmachineid' => $virtualMachineId,
        ));
    }
    
    /**
    * Updates the affinity/anti-affinity group associations of a virtual machine. The VM has to be stopped and restarted for the new properties to take effect.
    *
    * @param string $id The ID of the virtual machine
    * @param string $affinityGroupIds comma separated list of affinity groups id that
    *        are going to be applied to the virtual machine. Should be passed only when vm is
    *        created from a zone with Basic Network support. Mutually exclusive with
    *        securitygroupnames parameter
    * @param string $affinityGroupNames comma separated list of affinity groups names
    *        that are going to be applied to the virtual machine. Should be passed only when
    *        vm is created from a zone with Basic Network support. Mutually exclusive with
    *        securitygroupids parameter
    */
    
    public function updateVMAffinityGroup($id, $affinityGroupIds = "", $affinityGroupNames = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateVMAffinityGroup", array(
            'id' => $id,
            'affinitygroupids' => $affinityGroupIds,
            'affinitygroupnames' => $affinityGroupNames,
        ));
    }
    
    /**
    * Lists affinity group types available
    *
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listAffinityGroupTypes($keyword = "", $page = "", $pageSize = "") {

        return $this->request("listAffinityGroupTypes", array(
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Creates a vm group
    *
    * @param string $name the name of the instance group
    * @param string $account the account of the instance group. The account parameter
    *        must be used with the domainId parameter.
    * @param string $domainId the domain ID of account owning the instance group
    * @param string $projectId The project of the instance group
    */
    
    public function createInstanceGroup($name, $account = "", $domainId = "", $projectId = "") {

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        return $this->request("createInstanceGroup", array(
            'name' => $name,
            'account' => $account,
            'domainid' => $domainId,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * Deletes a vm group
    *
    * @param string $id the ID of the instance group
    */
    
    public function deleteInstanceGroup($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteInstanceGroup", array(
            'id' => $id,
        ));
    }
    
    /**
    * Updates a vm group
    *
    * @param string $id Instance group ID
    * @param string $name new instance group name
    */
    
    public function updateInstanceGroup($id, $name = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateInstanceGroup", array(
            'id' => $id,
            'name' => $name,
        ));
    }
    
    /**
    * Lists vm groups
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $id list instance groups by ID
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $name list instance groups by name
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    */
    
    public function listInstanceGroups($account = "", $domainId = "", $id = "", $isRecursive = "", $keyword = "", $listAll = "", $name = "", $page = "", $pageSize = "", $projectId = "") {

        return $this->request("listInstanceGroups", array(
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * Creates a service offering.
    *
    * @param string $displayText the display text of the service offering
    * @param string $name the name of the service offering
    * @param string $bytesReadRate bytes read rate of the disk offering
    * @param string $bytesWriteRate bytes write rate of the disk offering
    * @param string $cpuNumber the CPU number of the service offering
    * @param string $cpuSpeed the CPU speed of the service offering in MHz.
    * @param string $deploymentPlanner The deployment planner heuristics used to
    *        deploy a VM of this offering. If null, value of global config
    *        vm.deployment.planner is used
    * @param string $domainId the ID of the containing domain, null for public
    *        offerings
    * @param string $hosttags the host tag for this service offering.
    * @param string $iopsReadRate io requests read rate of the disk offering
    * @param string $iopsWriteRate io requests write rate of the disk offering
    * @param string $isSystem is this a system vm offering
    * @param string $isVolatile true if the virtual machine needs to be volatile so
    *        that on every reboot of VM, original root disk is dettached then destroyed and a
    *        fresh root disk is created and attached to VM
    * @param string $limitCpuUse restrict the CPU usage to committed service offering
    * @param string $memory the total memory of the service offering in MB
    * @param string $networkRate data transfer rate in megabits per second allowed.
    *        Supported only for non-System offering and system offerings having
    *        &quot;domainrouter&quot; systemvmtype
    * @param string $offerHa the HA for the service offering
    * @param string $serviceOfferingDetails details for planner, used to store
    *        specific parameters
    * @param string $storageType the storage type of the service offering. Values are
    *        local and shared.
    * @param string $systemVmType the system VM type. Possible types are
    *        &quot;domainrouter&quot;, &quot;consoleproxy&quot; and
    *        &quot;secondarystoragevm&quot;.
    * @param string $tags the tags for this service offering.
    */
    
    public function createServiceOffering($displayText, $name, $bytesReadRate = "", $bytesWriteRate = "", $cpuNumber = "", $cpuSpeed = "", $deploymentPlanner = "", $domainId = "", $hosttags = "", $iopsReadRate = "", $iopsWriteRate = "", $isSystem = "", $isVolatile = "", $limitCpuUse = "", $memory = "", $networkRate = "", $offerHa = "", $serviceOfferingDetails = "", $storageType = "", $systemVmType = "", $tags = "") {

        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        return $this->request("createServiceOffering", array(
            'displaytext' => $displayText,
            'name' => $name,
            'bytesreadrate' => $bytesReadRate,
            'byteswriterate' => $bytesWriteRate,
            'cpunumber' => $cpuNumber,
            'cpuspeed' => $cpuSpeed,
            'deploymentplanner' => $deploymentPlanner,
            'domainid' => $domainId,
            'hosttags' => $hosttags,
            'iopsreadrate' => $iopsReadRate,
            'iopswriterate' => $iopsWriteRate,
            'issystem' => $isSystem,
            'isvolatile' => $isVolatile,
            'limitcpuuse' => $limitCpuUse,
            'memory' => $memory,
            'networkrate' => $networkRate,
            'offerha' => $offerHa,
            'serviceofferingdetails' => $serviceOfferingDetails,
            'storagetype' => $storageType,
            'systemvmtype' => $systemVmType,
            'tags' => $tags,
        ));
    }
    
    /**
    * Deletes a service offering.
    *
    * @param string $id the ID of the service offering
    */
    
    public function deleteServiceOffering($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteServiceOffering", array(
            'id' => $id,
        ));
    }
    
    /**
    * Updates a service offering.
    *
    * @param string $id the ID of the service offering to be updated
    * @param string $displayText the display text of the service offering to be
    *        updated
    * @param string $name the name of the service offering to be updated
    * @param string $sortKey sort key of the service offering, integer
    */
    
    public function updateServiceOffering($id, $displayText = "", $name = "", $sortKey = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateServiceOffering", array(
            'id' => $id,
            'displaytext' => $displayText,
            'name' => $name,
            'sortkey' => $sortKey,
        ));
    }
    
    /**
    * Lists all available service offerings.
    *
    * @param string $domainId the ID of the domain associated with the service
    *        offering
    * @param string $id ID of the service offering
    * @param string $isSystem is this a system vm offering
    * @param string $keyword List by keyword
    * @param string $name name of the service offering
    * @param string $page 
    * @param string $pageSize 
    * @param string $systemVmType the system VM type. Possible types are
    *        &quot;consoleproxy&quot;, &quot;secondarystoragevm&quot; or
    *        &quot;domainrouter&quot;.
    * @param string $virtualMachineId the ID of the virtual machine. Pass this in if
    *        you want to see the available service offering that a virtual machine can be
    *        changed to.
    */
    
    public function listServiceOfferings($domainId = "", $id = "", $isSystem = "", $keyword = "", $name = "", $page = "", $pageSize = "", $systemVmType = "", $virtualMachineId = "") {

        return $this->request("listServiceOfferings", array(
            'domainid' => $domainId,
            'id' => $id,
            'issystem' => $isSystem,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'systemvmtype' => $systemVmType,
            'virtualmachineid' => $virtualMachineId,
        ));
    }
    
    /**
    * Adds a Region
    *
    * @param string $id Id of the Region
    * @param string $endPoint Region service endpoint
    * @param string $name Name of the region
    */
    
    public function addRegion($id, $endPoint, $name) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        if (empty($endPoint)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "endPoint"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        return $this->request("addRegion", array(
            'id' => $id,
            'endpoint' => $endPoint,
            'name' => $name,
        ));
    }
    
    /**
    * Updates a region
    *
    * @param string $id Id of region to update
    * @param string $endPoint updates region with this end point
    * @param string $name updates region with this name
    */
    
    public function updateRegion($id, $endPoint = "", $name = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateRegion", array(
            'id' => $id,
            'endpoint' => $endPoint,
            'name' => $name,
        ));
    }
    
    /**
    * Removes specified region
    *
    * @param string $id ID of the region to delete
    */
    
    public function removeRegion($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("removeRegion", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists Regions
    *
    * @param string $id List Region by region ID.
    * @param string $keyword List by keyword
    * @param string $name List Region by region name.
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listRegions($id = "", $keyword = "", $name = "", $page = "", $pageSize = "") {

        return $this->request("listRegions", array(
            'id' => $id,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Creates a network offering.
    *
    * @param string $displayText the display text of the network offering
    * @param string $guestIpType guest type of the network offering: Shared or
    *        Isolated
    * @param string $name the name of the network offering
    * @param string $supportedServices services supported by the network offering
    * @param string $trafficType the traffic type for the network offering. Supported
    *        type in current release is GUEST only
    * @param string $availability the availability of network offering. Default value
    *        is Optional
    * @param string $conserveMode true if the network offering is IP conserve mode
    *        enabled
    * @param string $details Network offering details in key/value pairs. Supported
    *        keys are internallbprovider/publiclbprovider with service provider as a value
    * @param string $egressDefaultPolicy true if default guest network egress policy
    *        is allow; false if default egress policy is deny
    * @param string $isPersistent true if network offering supports persistent
    *        networks; defaulted to false if not specified
    * @param string $keepAliveEnabled if true keepalive will be turned on in the
    *        loadbalancer. At the time of writing this has only an effect on haproxy; the
    *        mode http and httpclose options are unset in the haproxy conf file.
    * @param string $maxConnections maximum number of concurrent connections supported
    *        by the network offering
    * @param string $networkRate data transfer rate in megabits per second allowed
    * @param string $serviceCapabilityList desired service capabilities as part of
    *        network offering
    * @param string $serviceOfferingId the service offering ID used by virtual router
    *        provider
    * @param string $serviceProviderList provider to service mapping. If not
    *        specified, the provider for the service will be mapped to the default provider
    *        on the physical network
    * @param string $specifyIpRanges true if network offering supports specifying ip
    *        ranges; defaulted to false if not specified
    * @param string $specifyVlan true if network offering supports vlans
    * @param string $tags the tags for the network offering.
    */
    
    public function createNetworkOffering($displayText, $guestIpType, $name, $supportedServices, $trafficType, $availability = "", $conserveMode = "", $details = "", $egressDefaultPolicy = "", $isPersistent = "", $keepAliveEnabled = "", $maxConnections = "", $networkRate = "", $serviceCapabilityList = "", $serviceOfferingId = "", $serviceProviderList = "", $specifyIpRanges = "", $specifyVlan = "", $tags = "") {

        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }

        if (empty($guestIpType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "guestIpType"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($supportedServices)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "supportedServices"), MISSING_ARGUMENT);
        }

        if (empty($trafficType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "trafficType"), MISSING_ARGUMENT);
        }

        return $this->request("createNetworkOffering", array(
            'displaytext' => $displayText,
            'guestiptype' => $guestIpType,
            'name' => $name,
            'supportedservices' => $supportedServices,
            'traffictype' => $trafficType,
            'availability' => $availability,
            'conservemode' => $conserveMode,
            'details' => $details,
            'egressdefaultpolicy' => $egressDefaultPolicy,
            'ispersistent' => $isPersistent,
            'keepaliveenabled' => $keepAliveEnabled,
            'maxconnections' => $maxConnections,
            'networkrate' => $networkRate,
            'servicecapabilitylist' => $serviceCapabilityList,
            'serviceofferingid' => $serviceOfferingId,
            'serviceproviderlist' => $serviceProviderList,
            'specifyipranges' => $specifyIpRanges,
            'specifyvlan' => $specifyVlan,
            'tags' => $tags,
        ));
    }
    
    /**
    * Updates a network offering.
    *
    * @param string $availability the availability of network offering. Default value
    *        is Required for Guest Virtual network offering; Optional for Guest Direct
    *        network offering
    * @param string $displayText the display text of the network offering
    * @param string $id the id of the network offering
    * @param string $keepAliveEnabled if true keepalive will be turned on in the
    *        loadbalancer. At the time of writing this has only an effect on haproxy; the
    *        mode http and httpclose options are unset in the haproxy conf file.
    * @param string $maxConnections maximum number of concurrent connections supported
    *        by the network offering
    * @param string $name the name of the network offering
    * @param string $sortKey sort key of the network offering, integer
    * @param string $state update state for the network offering
    */
    
    public function updateNetworkOffering($availability = "", $displayText = "", $id = "", $keepAliveEnabled = "", $maxConnections = "", $name = "", $sortKey = "", $state = "") {

        return $this->request("updateNetworkOffering", array(
            'availability' => $availability,
            'displaytext' => $displayText,
            'id' => $id,
            'keepaliveenabled' => $keepAliveEnabled,
            'maxconnections' => $maxConnections,
            'name' => $name,
            'sortkey' => $sortKey,
            'state' => $state,
        ));
    }
    
    /**
    * Deletes a network offering.
    *
    * @param string $id the ID of the network offering
    */
    
    public function deleteNetworkOffering($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteNetworkOffering", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists all available network offerings.
    *
    * @param string $availability the availability of network offering. Default value
    *        is Required
    * @param string $displayText list network offerings by display text
    * @param string $forVpc the network offering can be used only for network creation
    *        inside the VPC
    * @param string $guestIpType list network offerings by guest type: Shared or
    *        Isolated
    * @param string $id list network offerings by id
    * @param string $isDefault true if need to list only default network offerings.
    *        Default value is false
    * @param string $isTagged true if offering has tags specified
    * @param string $keyword List by keyword
    * @param string $name list network offerings by name
    * @param string $networkId the ID of the network. Pass this in if you want to see
    *        the available network offering that a network can be changed to.
    * @param string $page 
    * @param string $pageSize 
    * @param string $sourceNatSupported true if need to list only netwok offerings
    *        where source nat is supported, false otherwise
    * @param string $specifyIpRanges true if need to list only network offerings which
    *        support specifying ip ranges
    * @param string $specifyVlan the tags for the network offering.
    * @param string $state list network offerings by state
    * @param string $supportedServices list network offerings supporting certain
    *        services
    * @param string $tags list network offerings by tags
    * @param string $trafficType list by traffic type
    * @param string $zoneId list netowrk offerings available for network creation in
    *        specific zone
    */
    
    public function listNetworkOfferings($availability = "", $displayText = "", $forVpc = "", $guestIpType = "", $id = "", $isDefault = "", $isTagged = "", $keyword = "", $name = "", $networkId = "", $page = "", $pageSize = "", $sourceNatSupported = "", $specifyIpRanges = "", $specifyVlan = "", $state = "", $supportedServices = "", $tags = "", $trafficType = "", $zoneId = "") {

        return $this->request("listNetworkOfferings", array(
            'availability' => $availability,
            'displaytext' => $displayText,
            'forvpc' => $forVpc,
            'guestiptype' => $guestIpType,
            'id' => $id,
            'isdefault' => $isDefault,
            'istagged' => $isTagged,
            'keyword' => $keyword,
            'name' => $name,
            'networkid' => $networkId,
            'page' => $page,
            'pagesize' => $pageSize,
            'sourcenatsupported' => $sourceNatSupported,
            'specifyipranges' => $specifyIpRanges,
            'specifyvlan' => $specifyVlan,
            'state' => $state,
            'supportedservices' => $supportedServices,
            'tags' => $tags,
            'traffictype' => $trafficType,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * A command to list events.
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $duration the duration of the event
    * @param string $endDate the end date range of the list you want to retrieve (use
    *        format &quot;yyyy-MM-dd&quot; or the new format &quot;yyyy-MM-dd
    *        HH:mm:ss&quot;)
    * @param string $entryTime the time the event was entered
    * @param string $id the ID of the event
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $level the event level (INFO, WARN, ERROR)
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $startDate the start date range of the list you want to retrieve
    *        (use format &quot;yyyy-MM-dd&quot; or the new format &quot;yyyy-MM-dd
    *        HH:mm:ss&quot;)
    * @param string $type the event type (see event types)
    */
    
    public function listEvents($account = "", $domainId = "", $duration = "", $endDate = "", $entryTime = "", $id = "", $isRecursive = "", $keyword = "", $level = "", $listAll = "", $page = "", $pageSize = "", $projectId = "", $startDate = "", $type = "") {

        return $this->request("listEvents", array(
            'account' => $account,
            'domainid' => $domainId,
            'duration' => $duration,
            'enddate' => $endDate,
            'entrytime' => $entryTime,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'level' => $level,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'startdate' => $startDate,
            'type' => $type,
        ));
    }
    
    /**
    * List Event Types
    *
    */
    
    public function listEventTypes() {

        return $this->request("listEventTypes", array(
        ));
    }
    
    /**
    * Archive one or more events.
    *
    * @param string $endDate end date range to archive events (including) this date
    *        (use format &quot;yyyy-MM-dd&quot; or the new format
    *        &quot;yyyy-MM-ddThh:mm:ss&quot;)
    * @param string $ids the IDs of the events
    * @param string $startDate start date range to archive events (including) this
    *        date (use format &quot;yyyy-MM-dd&quot; or the new format
    *        &quot;yyyy-MM-ddThh:mm:ss&quot;)
    * @param string $type archive by event type
    */
    
    public function archiveEvents($endDate = "", $ids = "", $startDate = "", $type = "") {

        return $this->request("archiveEvents", array(
            'enddate' => $endDate,
            'ids' => $ids,
            'startdate' => $startDate,
            'type' => $type,
        ));
    }
    
    /**
    * Delete one or more events.
    *
    * @param string $endDate end date range to delete events (including) this date
    *        (use format &quot;yyyy-MM-dd&quot; or the new format
    *        &quot;yyyy-MM-ddThh:mm:ss&quot;)
    * @param string $ids the IDs of the events
    * @param string $startDate start date range to delete events (including) this date
    *        (use format &quot;yyyy-MM-dd&quot; or the new format
    *        &quot;yyyy-MM-ddThh:mm:ss&quot;)
    * @param string $type delete by event type
    */
    
    public function deleteEvents($endDate = "", $ids = "", $startDate = "", $type = "") {

        return $this->request("deleteEvents", array(
            'enddate' => $endDate,
            'ids' => $ids,
            'startdate' => $startDate,
            'type' => $type,
        ));
    }
    
    /**
    * Creates a disk offering.
    *
    * @param string $displayText alternate display text of the disk offering
    * @param string $name name of the disk offering
    * @param string $bytesReadRate bytes read rate of the disk offering
    * @param string $bytesWriteRate bytes write rate of the disk offering
    * @param string $customized whether disk offering size is custom or not
    * @param string $customizedIops whether disk offering iops is custom or not
    * @param string $diskSize size of the disk offering in GB
    * @param string $displayOffering an optional field, whether to display the
    *        offering to the end user or not.
    * @param string $domainId the ID of the containing domain, null for public
    *        offerings
    * @param string $hypervisorSnapshotReserve Hypervisor snapshot reserve space as a
    *        percent of a volume (for managed storage using Xen or VMware)
    * @param string $iopsReadRate io requests read rate of the disk offering
    * @param string $iopsWriteRate io requests write rate of the disk offering
    * @param string $maxIops max iops of the disk offering
    * @param string $minIops min iops of the disk offering
    * @param string $storageType the storage type of the disk offering. Values are
    *        local and shared.
    * @param string $tags tags for the disk offering
    */
    
    public function createDiskOffering($displayText, $name, $bytesReadRate = "", $bytesWriteRate = "", $customized = "", $customizedIops = "", $diskSize = "", $displayOffering = "", $domainId = "", $hypervisorSnapshotReserve = "", $iopsReadRate = "", $iopsWriteRate = "", $maxIops = "", $minIops = "", $storageType = "", $tags = "") {

        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        return $this->request("createDiskOffering", array(
            'displaytext' => $displayText,
            'name' => $name,
            'bytesreadrate' => $bytesReadRate,
            'byteswriterate' => $bytesWriteRate,
            'customized' => $customized,
            'customizediops' => $customizedIops,
            'disksize' => $diskSize,
            'displayoffering' => $displayOffering,
            'domainid' => $domainId,
            'hypervisorsnapshotreserve' => $hypervisorSnapshotReserve,
            'iopsreadrate' => $iopsReadRate,
            'iopswriterate' => $iopsWriteRate,
            'maxiops' => $maxIops,
            'miniops' => $minIops,
            'storagetype' => $storageType,
            'tags' => $tags,
        ));
    }
    
    /**
    * Updates a disk offering.
    *
    * @param string $id ID of the disk offering
    * @param string $displayOffering an optional field, whether to display the
    *        offering to the end user or not.
    * @param string $displayText updates alternate display text of the disk offering
    *        with this value
    * @param string $name updates name of the disk offering with this value
    * @param string $sortKey sort key of the disk offering, integer
    */
    
    public function updateDiskOffering($id, $displayOffering = "", $displayText = "", $name = "", $sortKey = "") {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("updateDiskOffering", array(
            'id' => $id,
            'displayoffering' => $displayOffering,
            'displaytext' => $displayText,
            'name' => $name,
            'sortkey' => $sortKey,
        ));
    }
    
    /**
    * Updates a disk offering.
    *
    * @param string $id ID of the disk offering
    */
    
    public function deleteDiskOffering($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteDiskOffering", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists all available disk offerings.
    *
    * @param string $domainId the ID of the domain of the disk offering.
    * @param string $id ID of the disk offering
    * @param string $keyword List by keyword
    * @param string $name name of the disk offering
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listDiskOfferings($domainId = "", $id = "", $keyword = "", $name = "", $page = "", $pageSize = "") {

        return $this->request("listDiskOfferings", array(
            'domainid' => $domainId,
            'id' => $id,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Lists all alerts.
    *
    * @param string $id the ID of the alert
    * @param string $keyword List by keyword
    * @param string $name list by alert name
    * @param string $page 
    * @param string $pageSize 
    * @param string $type list by alert type
    */
    
    public function listAlerts($id = "", $keyword = "", $name = "", $page = "", $pageSize = "", $type = "") {

        return $this->request("listAlerts", array(
            'id' => $id,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'type' => $type,
        ));
    }
    
    /**
    * Archive one or more alerts.
    *
    * @param string $endDate end date range to archive alerts (including) this date
    *        (use format &quot;yyyy-MM-dd&quot; or the new format
    *        &quot;yyyy-MM-ddThh:mm:ss&quot;)
    * @param string $ids the IDs of the alerts
    * @param string $startDate start date range to archive alerts (including) this
    *        date (use format &quot;yyyy-MM-dd&quot; or the new format
    *        &quot;yyyy-MM-ddThh:mm:ss&quot;)
    * @param string $type archive by alert type
    */
    
    public function archiveAlerts($endDate = "", $ids = "", $startDate = "", $type = "") {

        return $this->request("archiveAlerts", array(
            'enddate' => $endDate,
            'ids' => $ids,
            'startdate' => $startDate,
            'type' => $type,
        ));
    }
    
    /**
    * Delete one or more alerts.
    *
    * @param string $endDate end date range to delete alerts (including) this date
    *        (use format &quot;yyyy-MM-dd&quot; or the new format
    *        &quot;yyyy-MM-ddThh:mm:ss&quot;)
    * @param string $ids the IDs of the alerts
    * @param string $startDate start date range to delete alerts (including) this date
    *        (use format &quot;yyyy-MM-dd&quot; or the new format
    *        &quot;yyyy-MM-ddThh:mm:ss&quot;)
    * @param string $type delete by alert type
    */
    
    public function deleteAlerts($endDate = "", $ids = "", $startDate = "", $type = "") {

        return $this->request("deleteAlerts", array(
            'enddate' => $endDate,
            'ids' => $ids,
            'startdate' => $startDate,
            'type' => $type,
        ));
    }
    
    /**
    * Generates an alert
    *
    * @param string $description Alert description
    * @param string $name Name of the alert
    * @param string $type Type of the alert
    * @param string $podId Pod id for which alert is generated
    * @param string $zoneId Zone id for which alert is generated
    */
    
    public function generateAlert($description, $name, $type, $podId = "", $zoneId = "") {

        if (empty($description)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "description"), MISSING_ARGUMENT);
        }

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($type)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "type"), MISSING_ARGUMENT);
        }

        return $this->request("generateAlert", array(
            'description' => $description,
            'name' => $name,
            'type' => $type,
            'podid' => $podId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Lists storage providers.
    *
    * @param string $type the type of storage provider: either primary or image
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listStorageProviders($type, $keyword = "", $page = "", $pageSize = "") {

        if (empty($type)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "type"), MISSING_ARGUMENT);
        }

        return $this->request("listStorageProviders", array(
            'type' => $type,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Puts storage pool into maintenance state
    *
    * @param string $id Primary storage ID
    */
    
    public function enableStorageMaintenance($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("enableStorageMaintenance", array(
            'id' => $id,
        ));
    }
    
    /**
    * Cancels maintenance for primary storage
    *
    * @param string $id the primary storage ID
    */
    
    public function cancelStorageMaintenance($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("cancelStorageMaintenance", array(
            'id' => $id,
        ));
    }
    
    /**
    * Creates resource tag(s)
    *
    * @param string $resourceIds list of resources to create the tags for
    * @param string $resourceType type of the resource
    * @param string $tags Map of tags (key/value pairs)
    * @param string $customer identifies client specific tag. When the value is not
    *        null, the tag can&#039;t be used by cloudStack code internally
    */
    
    public function createTags($resourceIds, $resourceType, $tags, $customer = "") {

        if (empty($resourceIds)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceIds"), MISSING_ARGUMENT);
        }

        if (empty($resourceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceType"), MISSING_ARGUMENT);
        }

        if (empty($tags)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "tags"), MISSING_ARGUMENT);
        }

        return $this->request("createTags", array(
            'resourceids' => $resourceIds,
            'resourcetype' => $resourceType,
            'tags' => $tags,
            'customer' => $customer,
        ));
    }
    
    /**
    * Deleting resource tag(s)
    *
    * @param string $resourceIds Delete tags for resource id(s)
    * @param string $resourceType Delete tag by resource type
    * @param string $tags Delete tags matching key/value pairs
    */
    
    public function deleteTags($resourceIds, $resourceType, $tags = "") {

        if (empty($resourceIds)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceIds"), MISSING_ARGUMENT);
        }

        if (empty($resourceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceType"), MISSING_ARGUMENT);
        }

        return $this->request("deleteTags", array(
            'resourceids' => $resourceIds,
            'resourcetype' => $resourceType,
            'tags' => $tags,
        ));
    }
    
    /**
    * List resource tag(s)
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $customer list by customer name
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $key list by key
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    * @param string $resourceId list by resource id
    * @param string $resourceType list by resource type
    * @param string $value list by value
    */
    
    public function listTags($account = "", $customer = "", $domainId = "", $isRecursive = "", $key = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $projectId = "", $resourceId = "", $resourceType = "", $value = "") {

        return $this->request("listTags", array(
            'account' => $account,
            'customer' => $customer,
            'domainid' => $domainId,
            'isrecursive' => $isRecursive,
            'key' => $key,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
            'resourceid' => $resourceId,
            'resourcetype' => $resourceType,
            'value' => $value,
        ));
    }
    
    /**
    * Adds detail for the Resource.
    *
    * @param string $details Map of (key/value pairs)
    * @param string $resourceId resource id to create the details for
    * @param string $resourceType type of the resource
    */
    
    public function addResourceDetail($details, $resourceId, $resourceType) {

        if (empty($details)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "details"), MISSING_ARGUMENT);
        }

        if (empty($resourceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceId"), MISSING_ARGUMENT);
        }

        if (empty($resourceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceType"), MISSING_ARGUMENT);
        }

        return $this->request("addResourceDetail", array(
            'details' => $details,
            'resourceid' => $resourceId,
            'resourcetype' => $resourceType,
        ));
    }
    
    /**
    * Removes detail for the Resource.
    *
    * @param string $resourceId Delete details for resource id
    * @param string $resourceType Delete detail by resource type
    * @param string $key Delete details matching key/value pairs
    */
    
    public function removeResourceDetail($resourceId, $resourceType, $key = "") {

        if (empty($resourceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceId"), MISSING_ARGUMENT);
        }

        if (empty($resourceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceType"), MISSING_ARGUMENT);
        }

        return $this->request("removeResourceDetail", array(
            'resourceid' => $resourceId,
            'resourcetype' => $resourceType,
            'key' => $key,
        ));
    }
    
    /**
    * List resource detail(s)
    *
    * @param string $resourceId list by resource id
    * @param string $resourceType list by resource type
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $forDisplay if set to true, only details marked with display=true,
    *        are returned. Always false is the call is made by the regular user
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $key list by key
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $projectId list objects by project
    */
    
    public function listResourceDetails($resourceId, $resourceType, $account = "", $domainId = "", $forDisplay = "", $isRecursive = "", $key = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $projectId = "") {

        if (empty($resourceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceId"), MISSING_ARGUMENT);
        }

        if (empty($resourceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceType"), MISSING_ARGUMENT);
        }

        return $this->request("listResourceDetails", array(
            'resourceid' => $resourceId,
            'resourcetype' => $resourceType,
            'account' => $account,
            'domainid' => $domainId,
            'fordisplay' => $forDisplay,
            'isrecursive' => $isRecursive,
            'key' => $key,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'projectid' => $projectId,
        ));
    }
    
    /**
    * adds a range of portable public IP's to a region
    *
    * @param string $endIp the ending IP address in the portable IP range
    * @param string $gateway the gateway for the portable IP range
    * @param string $netmask the netmask of the portable IP range
    * @param string $regionId Id of the Region
    * @param string $startIp the beginning IP address in the portable IP range
    * @param string $vlan VLAN id, if not specified defaulted to untagged
    */
    
    public function createPortableIpRange($endIp, $gateway, $netmask, $regionId, $startIp, $vlan = "") {

        if (empty($endIp)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "endIp"), MISSING_ARGUMENT);
        }

        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gateway"), MISSING_ARGUMENT);
        }

        if (empty($netmask)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "netmask"), MISSING_ARGUMENT);
        }

        if (empty($regionId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "regionId"), MISSING_ARGUMENT);
        }

        if (empty($startIp)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "startIp"), MISSING_ARGUMENT);
        }

        return $this->request("createPortableIpRange", array(
            'endip' => $endIp,
            'gateway' => $gateway,
            'netmask' => $netmask,
            'regionid' => $regionId,
            'startip' => $startIp,
            'vlan' => $vlan,
        ));
    }
    
    /**
    * deletes a range of portable public IP's associated with a region
    *
    * @param string $id Id of the portable ip range
    */
    
    public function deletePortableIpRange($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deletePortableIpRange", array(
            'id' => $id,
        ));
    }
    
    /**
    * list portable IP ranges
    *
    * @param string $id Id of the portable ip range
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $regionId Id of a Region
    */
    
    public function listPortableIpRanges($id = "", $keyword = "", $page = "", $pageSize = "", $regionId = "") {

        return $this->request("listPortableIpRanges", array(
            'id' => $id,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'regionid' => $regionId,
        ));
    }
    
    /**
    * Adds a Nicira NVP device
    *
    * @param string $hostname Hostname of ip address of the Nicira NVP Controller.
    * @param string $password Credentials to access the Nicira Controller API
    * @param string $physicalNetworkId the Physical Network ID
    * @param string $transportZoneUuid The Transportzone UUID configured on the Nicira
    *        Controller
    * @param string $userName Credentials to access the Nicira Controller API
    * @param string $l3GatewayServiceUuid The L3 Gateway Service UUID configured on
    *        the Nicira Controller
    */
    
    public function addNiciraNvpDevice($hostname, $password, $physicalNetworkId, $transportZoneUuid, $userName, $l3GatewayServiceUuid = "") {

        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostname"), MISSING_ARGUMENT);
        }

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }

        if (empty($transportZoneUuid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "transportZoneUuid"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        return $this->request("addNiciraNvpDevice", array(
            'hostname' => $hostname,
            'password' => $password,
            'physicalnetworkid' => $physicalNetworkId,
            'transportzoneuuid' => $transportZoneUuid,
            'username' => $userName,
            'l3gatewayserviceuuid' => $l3GatewayServiceUuid,
        ));
    }
    
    /**
    * delete a nicira nvp device
    *
    * @param string $nvpDeviceId Nicira device ID
    */
    
    public function deleteNiciraNvpDevice($nvpDeviceId) {

        if (empty($nvpDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nvpDeviceId"), MISSING_ARGUMENT);
        }

        return $this->request("deleteNiciraNvpDevice", array(
            'nvpdeviceid' => $nvpDeviceId,
        ));
    }
    
    /**
    * Lists Nicira NVP devices
    *
    * @param string $keyword List by keyword
    * @param string $nvpDeviceId nicira nvp device ID
    * @param string $page 
    * @param string $pageSize 
    * @param string $physicalNetworkId the Physical Network ID
    */
    
    public function listNiciraNvpDevices($keyword = "", $nvpDeviceId = "", $page = "", $pageSize = "", $physicalNetworkId = "") {

        return $this->request("listNiciraNvpDevices", array(
            'keyword' => $keyword,
            'nvpdeviceid' => $nvpDeviceId,
            'page' => $page,
            'pagesize' => $pageSize,
            'physicalnetworkid' => $physicalNetworkId,
        ));
    }
    
    /**
    * Assigns secondary IP to NIC
    *
    * @param string $nicId the ID of the nic to which you want to assign private IP
    * @param string $ipAddress Secondary IP Address
    */
    
    public function addIpToNic($nicId, $ipAddress = "") {

        if (empty($nicId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nicId"), MISSING_ARGUMENT);
        }

        return $this->request("addIpToNic", array(
            'nicid' => $nicId,
            'ipaddress' => $ipAddress,
        ));
    }
    
    /**
    * Removes secondary IP from the NIC.
    *
    * @param string $id the ID of the secondary ip address to nic
    */
    
    public function removeIpFromNic($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("removeIpFromNic", array(
            'id' => $id,
        ));
    }
    
    /**
    * list the vm nics  IP to NIC
    *
    * @param string $virtualMachineId the ID of the vm
    * @param string $keyword List by keyword
    * @param string $nicId the ID of the nic to to list IPs
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listNics($virtualMachineId, $keyword = "", $nicId = "", $page = "", $pageSize = "") {

        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }

        return $this->request("listNics", array(
            'virtualmachineid' => $virtualMachineId,
            'keyword' => $keyword,
            'nicid' => $nicId,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Adds a network device of one of the following types: ExternalDhcp, ExternalFirewall, ExternalLoadBalancer, PxeServer
    *
    * @param string $networkDeviceParameterList parameters for network device
    * @param string $networkDeviceType Network device type, now supports ExternalDhcp,
    *        PxeServer, NetscalerMPXLoadBalancer, NetscalerVPXLoadBalancer,
    *        NetscalerSDXLoadBalancer, F5BigIpLoadBalancer, JuniperSRXFirewall,
    *        PaloAltoFirewall
    */
    
    public function addNetworkDevice($networkDeviceParameterList = "", $networkDeviceType = "") {

        return $this->request("addNetworkDevice", array(
            'networkdeviceparameterlist' => $networkDeviceParameterList,
            'networkdevicetype' => $networkDeviceType,
        ));
    }
    
    /**
    * List network devices
    *
    * @param string $keyword List by keyword
    * @param string $networkDeviceParameterList parameters for network device
    * @param string $networkDeviceType Network device type, now supports ExternalDhcp,
    *        PxeServer, NetscalerMPXLoadBalancer, NetscalerVPXLoadBalancer,
    *        NetscalerSDXLoadBalancer, F5BigIpLoadBalancer, JuniperSRXFirewall,
    *        PaloAltoFirewall
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listNetworkDevice($keyword = "", $networkDeviceParameterList = "", $networkDeviceType = "", $page = "", $pageSize = "") {

        return $this->request("listNetworkDevice", array(
            'keyword' => $keyword,
            'networkdeviceparameterlist' => $networkDeviceParameterList,
            'networkdevicetype' => $networkDeviceType,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Deletes network device.
    *
    * @param string $id Id of network device to delete
    */
    
    public function deleteNetworkDevice($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteNetworkDevice", array(
            'id' => $id,
        ));
    }
    
    /**
    * List hypervisors
    *
    * @param string $zoneId the zone id for listing hypervisors.
    */
    
    public function listHypervisors($zoneId = "") {

        return $this->request("listHypervisors", array(
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Updates a hypervisor capabilities.
    *
    * @param string $id ID of the hypervisor capability
    * @param string $maxGuestsLimit the max number of Guest VMs per host for this
    *        hypervisor.
    * @param string $securityGroupEnabled set true to enable security group for this
    *        hypervisor.
    */
    
    public function updateHypervisorCapabilities($id = "", $maxGuestsLimit = "", $securityGroupEnabled = "") {

        return $this->request("updateHypervisorCapabilities", array(
            'id' => $id,
            'maxguestslimit' => $maxGuestsLimit,
            'securitygroupenabled' => $securityGroupEnabled,
        ));
    }
    
    /**
    * Lists all hypervisor capabilities.
    *
    * @param string $hypervisor the hypervisor for which to restrict the search
    * @param string $id ID of the hypervisor capability
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listHypervisorCapabilities($hypervisor = "", $id = "", $keyword = "", $page = "", $pageSize = "") {

        return $this->request("listHypervisorCapabilities", array(
            'hypervisor' => $hypervisor,
            'id' => $id,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Adds F5 external load balancer appliance.
    *
    * @param string $password Password of the external load balancer appliance.
    * @param string $url URL of the external load balancer appliance.
    * @param string $userName Username of the external load balancer appliance.
    * @param string $zoneId Zone in which to add the external load balancer
    *        appliance.
    */
    
    public function addExternalLoadBalancer($password, $url, $userName, $zoneId) {

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("addExternalLoadBalancer", array(
            'password' => $password,
            'url' => $url,
            'username' => $userName,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Deletes a F5 external load balancer appliance added in a zone.
    *
    * @param string $id Id of the external loadbalancer appliance.
    */
    
    public function deleteExternalLoadBalancer($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteExternalLoadBalancer", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists F5 external load balancer appliances added in a zone.
    *
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $zoneId zone Id
    */
    
    public function listExternalLoadBalancers($keyword = "", $page = "", $pageSize = "", $zoneId = "") {

        return $this->request("listExternalLoadBalancers", array(
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Adds an external firewall appliance
    *
    * @param string $password Password of the external firewall appliance.
    * @param string $url URL of the external firewall appliance.
    * @param string $userName Username of the external firewall appliance.
    * @param string $zoneId Zone in which to add the external firewall appliance.
    */
    
    public function addExternalFirewall($password, $url, $userName, $zoneId) {

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("addExternalFirewall", array(
            'password' => $password,
            'url' => $url,
            'username' => $userName,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Deletes an external firewall appliance.
    *
    * @param string $id Id of the external firewall appliance.
    */
    
    public function deleteExternalFirewall($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("deleteExternalFirewall", array(
            'id' => $id,
        ));
    }
    
    /**
    * List external firewall appliances.
    *
    * @param string $zoneId zone Id
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listExternalFirewalls($zoneId, $keyword = "", $page = "", $pageSize = "") {

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("listExternalFirewalls", array(
            'zoneid' => $zoneId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Adds a BigSwitch VNS device
    *
    * @param string $hostname Hostname of ip address of the BigSwitch VNS Controller.
    * @param string $physicalNetworkId the Physical Network ID
    */
    
    public function addBigSwitchVnsDevice($hostname, $physicalNetworkId) {

        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostname"), MISSING_ARGUMENT);
        }

        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }

        return $this->request("addBigSwitchVnsDevice", array(
            'hostname' => $hostname,
            'physicalnetworkid' => $physicalNetworkId,
        ));
    }
    
    /**
    * delete a bigswitch vns device
    *
    * @param string $vnsDeviceId BigSwitch device ID
    */
    
    public function deleteBigSwitchVnsDevice($vnsDeviceId) {

        if (empty($vnsDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vnsDeviceId"), MISSING_ARGUMENT);
        }

        return $this->request("deleteBigSwitchVnsDevice", array(
            'vnsdeviceid' => $vnsDeviceId,
        ));
    }
    
    /**
    * Lists BigSwitch Vns devices
    *
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $physicalNetworkId the Physical Network ID
    * @param string $vnsDeviceId bigswitch vns device ID
    */
    
    public function listBigSwitchVnsDevices($keyword = "", $page = "", $pageSize = "", $physicalNetworkId = "", $vnsDeviceId = "") {

        return $this->request("listBigSwitchVnsDevices", array(
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'physicalnetworkid' => $physicalNetworkId,
            'vnsdeviceid' => $vnsDeviceId,
        ));
    }
    
    /**
    * Acquires and associates a public IP to an account.
    *
    * @param string $account the account to associate with this IP address
    * @param string $domainId the ID of the domain to associate with this IP address
    * @param string $isPortable should be set to true if public IP is required to be
    *        transferable across zones, if not specified defaults to false
    * @param string $networkId The network this ip address should be associated to.
    * @param string $projectId Deploy vm for the project
    * @param string $regionId region ID from where portable ip is to be associated.
    * @param string $vpcId the VPC you want the ip address to be associated with
    * @param string $zoneId the ID of the availability zone you want to acquire an
    *        public IP address from
    */
    
    public function associateIpAddress($account = "", $domainId = "", $isPortable = "", $networkId = "", $projectId = "", $regionId = "", $vpcId = "", $zoneId = "") {

        return $this->request("associateIpAddress", array(
            'account' => $account,
            'domainid' => $domainId,
            'isportable' => $isPortable,
            'networkid' => $networkId,
            'projectid' => $projectId,
            'regionid' => $regionId,
            'vpcid' => $vpcId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Disassociates an ip address from the account.
    *
    * @param string $id the id of the public ip address to disassociate
    */
    
    public function disassociateIpAddress($id) {

        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }

        return $this->request("disassociateIpAddress", array(
            'id' => $id,
        ));
    }
    
    /**
    * Lists all public ip addresses
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $allocatedOnly limits search results to allocated public IP
    *        addresses
    * @param string $associatedNetworkId lists all public IP addresses associated to
    *        the network specified
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $forLoadBalancing list only ips used for load balancing
    * @param string $forVirtualNetwork the virtual network for the IP address
    * @param string $id lists ip address by id
    * @param string $ipAddress lists the specified IP address
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $isSourceNat list only source nat ip addresses
    * @param string $isStaticNat list only static nat ip addresses
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $physicalNetworkId lists all public IP addresses by physical
    *        network id
    * @param string $projectId list objects by project
    * @param string $tags List resources by tags (key/value pairs)
    * @param string $vlanId lists all public IP addresses by VLAN ID
    * @param string $vpcId List ips belonging to the VPC
    * @param string $zoneId lists all public IP addresses by Zone ID
    */
    
    public function listPublicIpAddresses($account = "", $allocatedOnly = "", $associatedNetworkId = "", $domainId = "", $forLoadBalancing = "", $forVirtualNetwork = "", $id = "", $ipAddress = "", $isRecursive = "", $isSourceNat = "", $isStaticNat = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $physicalNetworkId = "", $projectId = "", $tags = "", $vlanId = "", $vpcId = "", $zoneId = "") {

        return $this->request("listPublicIpAddresses", array(
            'account' => $account,
            'allocatedonly' => $allocatedOnly,
            'associatednetworkid' => $associatedNetworkId,
            'domainid' => $domainId,
            'forloadbalancing' => $forLoadBalancing,
            'forvirtualnetwork' => $forVirtualNetwork,
            'id' => $id,
            'ipaddress' => $ipAddress,
            'isrecursive' => $isRecursive,
            'issourcenat' => $isSourceNat,
            'isstaticnat' => $isStaticNat,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'physicalnetworkid' => $physicalNetworkId,
            'projectid' => $projectId,
            'tags' => $tags,
            'vlanid' => $vlanId,
            'vpcid' => $vpcId,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Adds Swift.
    *
    * @param string $url the URL for swift
    * @param string $account the account for swift
    * @param string $key key for the user for swift
    * @param string $userName the username for swift
    */
    
    public function addSwift($url, $account = "", $key = "", $userName = "") {

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        return $this->request("addSwift", array(
            'url' => $url,
            'account' => $account,
            'key' => $key,
            'username' => $userName,
        ));
    }
    
    /**
    * List Swift.
    *
    * @param string $id the id of the swift
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listSwifts($id = "", $keyword = "", $page = "", $pageSize = "") {

        return $this->request("listSwifts", array(
            'id' => $id,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Adds S3
    *
    * @param string $accessKey S3 access key
    * @param string $bucket name of the template storage bucket
    * @param string $secretKey S3 secret key
    * @param string $connectionTimeout connection timeout (milliseconds)
    * @param string $endPoint S3 host name
    * @param string $maxErrorRetry maximum number of times to retry on error
    * @param string $socketTimeout socket timeout (milliseconds)
    * @param string $useHttps connect to the S3 endpoint via HTTPS?
    */
    
    public function addS3($accessKey, $bucket, $secretKey, $connectionTimeout = "", $endPoint = "", $maxErrorRetry = "", $socketTimeout = "", $useHttps = "") {

        if (empty($accessKey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "accessKey"), MISSING_ARGUMENT);
        }

        if (empty($bucket)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "bucket"), MISSING_ARGUMENT);
        }

        if (empty($secretKey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "secretKey"), MISSING_ARGUMENT);
        }

        return $this->request("addS3", array(
            'accesskey' => $accessKey,
            'bucket' => $bucket,
            'secretkey' => $secretKey,
            'connectiontimeout' => $connectionTimeout,
            'endpoint' => $endPoint,
            'maxerrorretry' => $maxErrorRetry,
            'sockettimeout' => $socketTimeout,
            'usehttps' => $useHttps,
        ));
    }
    
    /**
    * Lists S3s
    *
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listS3s($keyword = "", $page = "", $pageSize = "") {

        return $this->request("listS3s", array(
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Lists all supported OS types for this cloud.
    *
    * @param string $description list os by description
    * @param string $id list by Os type Id
    * @param string $keyword List by keyword
    * @param string $osCategoryId list by Os Category id
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listOsTypes($description = "", $id = "", $keyword = "", $osCategoryId = "", $page = "", $pageSize = "") {

        return $this->request("listOsTypes", array(
            'description' => $description,
            'id' => $id,
            'keyword' => $keyword,
            'oscategoryid' => $osCategoryId,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Lists all supported OS categories for this cloud.
    *
    * @param string $id list Os category by id
    * @param string $keyword List by keyword
    * @param string $name list os category by name
    * @param string $page 
    * @param string $pageSize 
    */
    
    public function listOsCategories($id = "", $keyword = "", $name = "", $page = "", $pageSize = "") {

        return $this->request("listOsCategories", array(
            'id' => $id,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
        ));
    }
    
    /**
    * Retrieves the current status of asynchronous job.
    *
    * @param string $jobId the ID of the asychronous job
    */
    
    public function queryAsyncJobResult($jobId) {

        if (empty($jobId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "jobId"), MISSING_ARGUMENT);
        }

        return $this->request("queryAsyncJobResult", array(
            'jobid' => $jobId,
        ));
    }
    
    /**
    * Lists all pending asynchronous jobs for the account.
    *
    * @param string $account list resources by account. Must be used with the domainId
    *        parameter.
    * @param string $domainId list only resources belonging to the domain specified
    * @param string $isRecursive defaults to false, but if true, lists all resources
    *        from the parent specified by the domainId till leaves.
    * @param string $keyword List by keyword
    * @param string $listAll If set to false, list only resources belonging to the
    *        command&#039;s caller; if set to true - list resources that the caller is
    *        authorized to see. Default value is false
    * @param string $page 
    * @param string $pageSize 
    * @param string $startDate the start date of the async job
    */
    
    public function listAsyncJobs($account = "", $domainId = "", $isRecursive = "", $keyword = "", $listAll = "", $page = "", $pageSize = "", $startDate = "") {

        return $this->request("listAsyncJobs", array(
            'account' => $account,
            'domainid' => $domainId,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'listall' => $listAll,
            'page' => $page,
            'pagesize' => $pageSize,
            'startdate' => $startDate,
        ));
    }
    
    /**
    * Lists all the system wide capacities.
    *
    * @param string $clusterId lists capacity by the Cluster ID
    * @param string $fetchLatest recalculate capacities and fetch the latest
    * @param string $keyword List by keyword
    * @param string $page 
    * @param string $pageSize 
    * @param string $podId lists capacity by the Pod ID
    * @param string $sortBy Sort the results. Available values: Usage
    * @param string $type lists capacity by type* CAPACITY_TYPE_MEMORY = 0*
    *        CAPACITY_TYPE_CPU = 1* CAPACITY_TYPE_STORAGE = 2*
    *        CAPACITY_TYPE_STORAGE_ALLOCATED = 3* CAPACITY_TYPE_VIRTUAL_NETWORK_PUBLIC_IP =
    *        4* CAPACITY_TYPE_PRIVATE_IP = 5* CAPACITY_TYPE_SECONDARY_STORAGE = 6*
    *        CAPACITY_TYPE_VLAN = 7* CAPACITY_TYPE_DIRECT_ATTACHED_PUBLIC_IP = 8*
    *        CAPACITY_TYPE_LOCAL_STORAGE = 9.
    * @param string $zoneId lists capacity by the Zone ID
    */
    
    public function listCapacity($clusterId = "", $fetchLatest = "", $keyword = "", $page = "", $pageSize = "", $podId = "", $sortBy = "", $type = "", $zoneId = "") {

        return $this->request("listCapacity", array(
            'clusterid' => $clusterId,
            'fetchlatest' => $fetchLatest,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'podid' => $podId,
            'sortby' => $sortBy,
            'type' => $type,
            'zoneid' => $zoneId,
        ));
    }
    
    /**
    * Logs out the user
    *
    */
    
    public function logout() {

        return $this->request("logout", array(
        ));
    }
    
    /**
    * Logs a user into the CloudStack. A successful login attempt will generate a JSESSIONID cookie value that can be passed in subsequent Query command calls until the "logout" command has been issued or the session has expired.
    *
    * @param string $userName Username
    * @param string $password Hashed password (Default is MD5). If you wish to use any
    *        other hashing algorithm, you would need to write a custom authentication adapter
    *        See Docs section.
    * @param string $domain path of the domain that the user belongs to. Example:
    *        domain=/com/cloud/internal.  If no domain is passed in, the ROOT domain is
    *        assumed.
    * @param string $domainId id of the domain that the user belongs to. If both
    *        domain and domainId are passed in, &quot;domainId&quot; parameter takes
    *        precendence
    */
    
    public function login($userName, $password, $domain = "", $domainId = "") {

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }

        return $this->request("login", array(
            'username' => $userName,
            'password' => $password,
            'domain' => $domain,
            'domainId' => $domainId,
        ));
    }
    
    /**
    * Creates an account from an LDAP user
    *
    * @param string $accountType Type of the account.  Specify 0 for user, 1 for root
    *        admin, and 2 for domain admin
    * @param string $userName Unique username.
    * @param string $account Creates the user under the specified account. If no
    *        account is specified, the username will be used as the account name.
    * @param string $accountDetails details for account used to store specific
    *        parameters
    * @param string $accountId Account UUID, required for adding account from external
    *        provisioning system
    * @param string $domainId Creates the user under the specified domain.
    * @param string $networkDomain Network domain for the account&#039;s networks
    * @param string $timezone Specifies a timezone for this command. For more
    *        information on the timezone parameter, see Time Zone Format.
    * @param string $userId User UUID, required for adding account from external
    *        provisioning system
    */
    
    public function ldapCreateAccount($accountType, $userName, $account = "", $accountDetails = "", $accountId = "", $domainId = "", $networkDomain = "", $timezone = "", $userId = "") {

        if (empty($accountType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "accountType"), MISSING_ARGUMENT);
        }

        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }

        return $this->request("ldapCreateAccount", array(
            'accounttype' => $accountType,
            'username' => $userName,
            'account' => $account,
            'accountdetails' => $accountDetails,
            'accountid' => $accountId,
            'domainid' => $domainId,
            'networkdomain' => $networkDomain,
            'timezone' => $timezone,
            'userid' => $userId,
        ));
    }
    
    /**
    * Retrieves a cloud identifier.
    *
    * @param string $userId the user ID for the cloud identifier
    */
    
    public function getCloudIdentifier($userId) {

        if (empty($userId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userId"), MISSING_ARGUMENT);
        }

        return $this->request("getCloudIdentifier", array(
            'userid' => $userId,
        ));
    }
    
    /**
    * Uploads a custom certificate for the console proxy VMs to use for SSL. Can be used to upload a single certificate signed by a known CA. Can also be used, through multiple calls, to upload a chain of certificates from CA to the custom certificate itself.
    *
    * @param string $certificate The certificate to be uploaded.
    * @param string $domainSuffix DNS domain suffix that the certificate is granted
    *        for.
    * @param string $id An integer providing the location in a chain that the
    *        certificate will hold. Usually, this can be left empty. When creating a chain,
    *        the top level certificate should have an ID of 1, with each step in the chain
    *        incrementing by one. Example, CA with id = 1, Intermediate CA with id = 2, Site
    *        certificate with ID = 3
    * @param string $name A name / alias for the certificate.
    * @param string $privateKey The private key for the attached certificate.
    */
    
    public function uploadCustomCertificate($certificate, $domainSuffix, $id = "", $name = "", $privateKey = "") {

        if (empty($certificate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "certificate"), MISSING_ARGUMENT);
        }

        if (empty($domainSuffix)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainSuffix"), MISSING_ARGUMENT);
        }

        return $this->request("uploadCustomCertificate", array(
            'certificate' => $certificate,
            'domainsuffix' => $domainSuffix,
            'id' => $id,
            'name' => $name,
            'privatekey' => $privateKey,
        ));
    }
    
    /**
    * lists all available apis on the server, provided by the Api Discovery plugin
    *
    * @param string $name API name
    */
    
    public function listApis($name = "") {

        return $this->request("listApis", array(
            'name' => $name,
        ));
    }
    
    /**
    * Adds stratosphere ssp server
    *
    * @param string $name stratosphere ssp api name
    * @param string $url stratosphere ssp server url
    * @param string $zoneId the zone ID
    * @param string $password stratosphere ssp api password
    * @param string $tenantUuid stratosphere ssp tenant uuid
    * @param string $userName stratosphere ssp api username
    */
    
    public function addStratosphereSsp($name, $url, $zoneId, $password = "", $tenantUuid = "", $userName = "") {

        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }

        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }

        return $this->request("addStratosphereSsp", array(
            'name' => $name,
            'url' => $url,
            'zoneid' => $zoneId,
            'password' => $password,
            'tenantuuid' => $tenantUuid,
            'username' => $userName,
        ));
    }
    
}