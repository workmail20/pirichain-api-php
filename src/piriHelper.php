<?php
namespace Workmail20\PirichainApiPhp;

class piriHelper
{
    private $mainEndpoit = "https://core.pirichain.com/";
    private $testEndpoit = "https://testnet.pirichain.com/";
    private $endpoint = "";

    private $CURL;

    public function __construct($mainNet = true)
    {
        switch ($mainNet) {
            case true:
                $this->endpoint = $this->mainEndpoit;
                break;
            case false:
                $this->endpoint = $this->testEndpoit;
        }
    }

    public function send_http_postJSON($url, $data)
    {
        $this->CURL = curl_init();
        $html = "";
        if ($this->CURL !== false) {
            $headers = [
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                'Accept-Language: uk,en;q=0.9,en-GB;q=0.8,en-US;q=0.7,ru;q=0.6',
                'Cache-Control: no-cache',
                "Content-Length: " . strlen($data),
                "Content-Type: application/json",
                'Origin: null',
                'Pragma: no-cache',
                'Sec-Ch-Ua: "Microsoft Edge";v="93", " Not;A Brand";v="99", "Chromium";v="93"',
                'Sec-Ch-Ua-mobile: ?0',
                'Sec-Ch-Ua-platform: "Windows"',
                'Sec-Fetch-Dest: document"',
                'Sec-Fetch-Mode: navigate',
                'Sec-Fetch-Site: same-origin',
                'Sec-Fetch-User: ?1',
                'Upgrade-Insecure-Requests: 1',
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36 Edg/93.0.961.47'
            ];
            curl_setopt($this->CURL, CURLOPT_URL, $url);
            curl_setopt($this->CURL, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($this->CURL, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($this->CURL, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($this->CURL, CURLOPT_HEADER, false);
            curl_setopt($this->CURL, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($this->CURL, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($this->CURL, CURLOPT_CONNECTTIMEOUT, 60);
            curl_setopt($this->CURL, CURLOPT_POST, 1);
            curl_setopt($this->CURL, CURLOPT_POSTFIELDS, $data);
            curl_setopt($this->CURL, CURLOPT_FRESH_CONNECT, TRUE);
            curl_setopt($this->CURL, CURLOPT_POSTREDIR, CURL_REDIR_POST_ALL);
            $html = curl_exec($this->CURL);
            if (curl_errno($this->CURL)) {
                throw new Exception("Error: " . curl_error($this->CURL));
            }
            curl_close($this->CURL);
        }
        return $html;
    }

    //Wallet-Account
    public function createNewAddress($language = "english", $commercial = false)
    {
        return $this->send_http_postJSON($this->endpoint . "createNewAddress", json_encode(["language" => $language, "isCommercial" => json_encode($commercial)]));
    }

    public function rescuePrivateKey($words, $language = "english")
    {
        if (strlen($words) < 8) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "rescuePrivateKey", json_encode(["words" => $words, "language" => $language]));
    }

    public function getMnemonic($privateKey, $language = "english")
    {
        if (strlen($privateKey) < 8) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "getMnemonic", json_encode(["privateKey" => $privateKey, "language" => $language]));
    }

    public function getBalance($address, $assetID = "-1")
    {
        if (strlen($address) < 8) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "getBalance", json_encode(["address" => $address, "assetID" => (string)$assetID]));
    }

    public function getBalanceList($address)
    {
        if (strlen($address) < 8) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "getBalanceList", json_encode(["address" => $address]));
    }


    //Token
    public function getToken($assetID = "-1")
    {
        return $this->send_http_postJSON($this->endpoint . "getToken", json_encode(["assetID" => (string)$assetID]));
    }

    public function listTokens($skip = "0", $limit = "10")
    {
        return $this->send_http_postJSON($this->endpoint . "listTokens", json_encode(["skip" => (string)$skip, "limit" => (string)$limit]));
    }

    public function sendToken($address, $privateKey, $to, $amount, $assetID = "-1")
    {
        if ((strlen($address) < 8) || (strlen($privateKey) < 8) || (strlen($to) < 8)) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "sendToken", json_encode(["address" => $address, "privateKey" => $privateKey, "to" => $to, "amount" => (string)$amount, "assetID" => (string)$assetID]));
    }

    public function createToken(
        $creatorAddress,
        $privateKey,
        $tokenName,
        $tokenSymbol,
        $totalSupply,
        $logo,
        $decimals,
        $description,
        $webSite,
        $socialMediaFacebookURL,
        $socialMediaTwitterURL,
        $socialMediaMediumURL,
        $socialMediaYoutubeURL,
        $socialMediaRedditURL,
        $socialMediaBitcoinTalkURL,
        $socialMediaInstagramURL,
        $mailAddress,
        $companyAddress,
        $sector,
        $hasAirdrop,
        $hasStake
    ) {
        return $this->send_http_postJSON($this->endpoint . "createToken", json_encode([
            "creatorAddress" => $creatorAddress, "privateKey" => $privateKey,
            "tokenName" => $tokenName, "tokenSymbol" => $tokenSymbol, "totalSupply" => (string)$totalSupply, "logo" => $logo, "decimals" => (string)$decimals,
            "description" => $description, "webSite" => $webSite, "socialMediaFacebookURL" => $socialMediaFacebookURL, "socialMediaTwitterURL" => $socialMediaTwitterURL,
            "socialMediaMediumURL" => $socialMediaMediumURL, "socialMediaYoutubeURL" => $socialMediaYoutubeURL, "socialMediaRedditURL" => $socialMediaRedditURL,
            "socialMediaBitcoinTalkURL" => $socialMediaBitcoinTalkURL,
            "socialMediaInstagramURL" => $socialMediaInstagramURL, "mailAddress" => $mailAddress, "companyAddress" => $companyAddress,
            "sector" => $sector, "hasAirdrop" => json_encode($hasAirdrop), "hasStake" => json_encode($hasStake)
        ]));
    }

    //Scenario
    public function getScenario($address)
    {
        if (strlen($address) < 8) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "getScenario", json_encode(["address" => $address]));
    }

    public function createScenario($address, $privateKey, $scenarioText, $name, $description, $tags)
    {
        if (strlen($address) < 8) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "createScenario", json_encode([
            "address" => $address, "privateKey" => $privateKey, "scenarioText" => $scenarioText,
            "name" => $name,
            "description" => $description, "tags" => $tags
        ]));
    }

    public function listMyScenarios($ownerAddress)
    {
        if (strlen($ownerAddress) < 8) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "listMyScenarios", json_encode(["ownerAddress" => $ownerAddress]));
    }

    public function listScenarios($skip = "0", $limit = "10")
    {
        return $this->send_http_postJSON($this->endpoint . "listScenarios", json_encode(["skip" => (string)$skip, "limit" => (string)$limit]));
    }

    public function executeScenario($scenarioAddress, $address, $privateKey, $method, $params)
    {
        //$params = ["Data1", "Data2"]

        return $this->send_http_postJSON($this->endpoint . "executeScenario", json_encode([
            "scenarioAddress" => $scenarioAddress, "address" => $address,
            "privateKey" => $privateKey, "method" => $method, "params" => $params
        ]));
    }


    public function previewScenario($scenarioText, $address, $privateKey, $method, $params)
    {
        //$params = ["Data1", "Data2"]

        return $this->send_http_postJSON($this->endpoint . "previewScenario", json_encode([
            "scenarioText" => $scenarioText, "address" => $address,
            "privateKey" => $privateKey, "method" => $method, "params" => $params
        ]));
    }

    //Transaction
    public function listTransactions($skip = "0", $limit = "50")
    {
        return $this->send_http_postJSON($this->endpoint . "listTransactions", json_encode(["skip" => (string)$skip, "limit" => (string)$limit]));
    }

    public function listPoolTransactions()
    {
        return $this->send_http_postJSON($this->endpoint . "listPoolTransactions", json_encode([]));
    }

    public function listTransactionsByAssetID($skip, $limit, $assetID="-1")
    {
        return $this->send_http_postJSON($this->endpoint . "listTransactionsByAssetID", json_encode(["skip" => (string)$skip, "limit" => (string)$limit, "assetID" => (string)$assetID]));
    }

    public function listTransactionsByAddr($skip, $limit, $address)
    {
        return $this->send_http_postJSON($this->endpoint . "listTransactionsByAddr", json_encode(["skip" => (string)$skip, "limit" => (string)$limit, "address" => $address]));
    }

    public function getTransaction($tx)
    {
        if (strlen($tx) < 8) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "getTransaction", json_encode(["tx" => $tx]));
    }

    public function getPoolTransaction($tx)
    {
        if (strlen($tx) < 8) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "getPoolTransaction", json_encode(["tx" => $tx]));
    }

    public function getDetailsOfAddress($address)
    {
        if (strlen($address) < 8) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "getDetailsOfAddress", json_encode(["address" => $address]));
    }

    //block
    public function getBlocks($skip = "0", $limit = "10")
    {
        return $this->send_http_postJSON($this->endpoint . "getBlocks", json_encode(["skip" => (string)$skip, "limit" => (string)$limit]));
    }

    public function getBlocksDesc($skip = "0", $limit = "10")
    {
        return $this->send_http_postJSON($this->endpoint . "getBlocksDesc", json_encode(["skip" => (string)$skip, "limit" => (string)$limit]));
    }

    public function getLastBlocks($limit = "10")
    {
        return $this->send_http_postJSON($this->endpoint . "getLastBlocks", json_encode(["limit" => (string)$limit]));
    }

    public function getOnlyBlocks($skip = "0", $limit = "10")
    {
        return $this->send_http_postJSON($this->endpoint . "getOnlyBlocks", json_encode(["skip" => (string)$skip, "limit" => (string)$limit]));
    }

    public function getBlock($blockNumber)
    {
        if (strlen($blockNumber) < 1) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "getBlock", json_encode(["blockNumber" => (string)$blockNumber]));
    }

    //data
    public function decrypt($customID, $privateKey, $receiptPub)
    {
        return $this->send_http_postJSON($this->endpoint . "decrypt", json_encode(["customID" => $customID, "privateKey" => $privateKey, "receiptPub" => $receiptPub]));
    }

    public function pushData($address, $privateKey, $to, $customData, $inPubKey)
    {
        if (strlen($address) < 8) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "pushData", json_encode([
            "address" => $address, "privateKey" => $privateKey, "to" => $to,
            "customData" => $customData, "inPubKey" => $inPubKey
        ]));
    }


    public function pushDataList($address, $privateKey, $to, $customData)
    {
        if (strlen($address) < 8) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "pushDataList", json_encode([
            "address" => $address, "privateKey" => $privateKey, "to" => $to,
            "customData" => (string)$customData
        ]));
    }

    public function listData($skip = "0", $limit = "10")
    {
        return $this->send_http_postJSON($this->endpoint . "listData", json_encode(["skip" => (string)$skip, "limit" => (string)$limit]));
    }

    public function listDataByAddress($address, $skip = "0", $limit = "10")
    {
        if (strlen($address) < 8) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "listDataByAddress", json_encode(["address" => $address, "skip" => (string)$skip, "limit" => (string)$limit]));
    }

    public function getAddressListByAsset($assetID = "-1", $start = "0", $limit = "10")
    {
        return $this->send_http_postJSON($this->endpoint . "getAddressListByAsset", json_encode(["assetID" => (string)$assetID, "start" => (string)$start, "limit" => (string)$limit]));
    }
    // /Utility
    public function isValidAddress($address)
    {
        if (strlen($address) < 8) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "isValidAddress", json_encode(["address" => $address]));
    }

    public function search($value)
    {
        if (strlen($value) < 1) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "search", json_encode(["value" => $value]));
    }

    //Delegation
    public function listMyDelegation($delegationAddress, $delegationPrivateKey)
    {
        return $this->send_http_postJSON($this->endpoint . "listMyDelegation", json_encode(["delegationAddress" => $delegationAddress, "delegationPrivateKey" => $delegationPrivateKey]));
    }
    public function unFreezeCoin($delegationAddress, $delegationPrivateKey, $nodeAddress, $txHash)
    {
        return $this->send_http_postJSON($this->endpoint . "unFreezeCoin", json_encode([
            "delegationAddress" => $delegationAddress, "delegationPrivateKey" => $delegationPrivateKey,
            "nodeAddress" => $nodeAddress, "txHash" => $txHash
        ]));
    }

    public function freezeCoin($delegationAddress, $delegationPrivateKey, $duptyAddress, $amount)
    {
        return $this->send_http_postJSON($this->endpoint . "freezeCoin", json_encode([
            "delegationAddress" => $delegationAddress, "delegationPrivateKey" => $delegationPrivateKey,
            "duptyAddress" => $duptyAddress, "amount" => (string)$amount
        ]));
    }

    public function joinAsDeputy($address, $privateKey, $alias)
    {
        if (strlen($address) < 8) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "joinAsDeputy", json_encode([
            "address" => $address, "privateKey" => $privateKey,
            "alias" => $alias
        ]));
    }

    public function checkDeputy($address)
    {
        if (strlen($address) < 8) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "checkDeputy", json_encode(["address" => $address]));
    }


    public function listDeputies()
    {
        return $this->send_http_postJSON($this->endpoint . "listDeputies", json_encode([]));
    }

    public function getMyRewardQuantity($base58, $privateKey)
    {
        if (strlen($base58) < 8) throw new Exception("Error: line-" . __LINE__);
        return $this->send_http_postJSON($this->endpoint . "getMyRewardQuantity", json_encode(["base58" => $base58, "privateKey" => $privateKey]));
    }

    public function createAddressForBuyPiri($type)
    {
        return $this->send_http_postJSON($this->endpoint . "createAddressForBuyPiri", json_encode(["type" => (string)$type]));
    }

    public function getBalanceForBuyPiri($type, $address, $piriAddress)
    {
        return $this->send_http_postJSON($this->endpoint . "getBalanceForBuyPiri", json_encode(["type" => (string)$type, "address" => $address, "piriAddress" => $piriAddress]));
    }

    public function getPiriPrice($type = "busd")
    {
        return $this->send_http_postJSON($this->endpoint . "getPiriPrice", json_encode(["type" => (string)$type]));
    }

    //Stats
    public function getRichList($assetID = "-1", $skip = "0", $limit = "10")
    {
        return $this->send_http_postJSON($this->endpoint . "getRichList", json_encode(["assetID" => (string) $assetID, "skip" => (string)$skip, "limit" => (string)$limit]));
    }

    public function getDetailStats($assetID = "-1")
    {
        return $this->send_http_postJSON($this->endpoint . "getDetailStats", json_encode(["assetID" => (string)$assetID]));
    }

    public function getStats()
    {
        return $this->send_http_postJSON($this->endpoint . "getStats", json_encode([]));
    }

    public function listDelegationTopN()
    {
        return $this->send_http_postJSON($this->endpoint . "listDelegationTopN", json_encode([]));
    }

    public function getCirculation()
    {
        return $this->send_http_postJSON($this->endpoint . "getCirculation", json_encode([]));
    }
}
