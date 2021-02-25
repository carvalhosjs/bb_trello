<?php
namespace BBTrello\Core;
use BBCurl\Core\Request;
use http\Exception;

/**
 * Class Trello - Comunicação com trello.
 * @author Carlos Mateus Carvalho <carvalho.ti.adm@gmail.com>
 * @package Source\Core
 */
class Trello {

    /**
     * @var string - Chave da api
     */
    private $key;

    /**
     * @var  - Token secreto da api
     */
    private $token;


    /**
     * Trello constructor.
     * @param $key - Parâmetro key da API
     * @param $token - Parâmetro do Token do API
     */
    public function __construct($key, $token)
    {
        $this->key = $key;
        $this->token = $token;
    }

    /*BOARD*/
    /**
     * Método responsável por criar um quadro.
     * (*) Campos Obrigatórios
     * @param array $data - Parâmetro em array dos configurações ex.: ['name*' => 'Nome do Quadro', 'desc' => 'descricao', 'idOrganization' => 'codigo do time ou org' ,'idBoardSource' => 'codigo do quadro que deja gazer uma copia']
     * @return mixed
     */
    public function addBoard(array $data){
        if(!empty($data)){
            $path = "/boards/";
            return $this->post($path, $data);
        }
    }


    /**
     * Método responsável por ler os membros do quadro
     * @param string $boardID
     * @return array
     */
    public function getMembersBoard(string $boardID)
    {
        $path = "boards/{$boardID}/members";
        return $this->get($path);
    }


    /**
     * Método responsável por convidar pessoas para o quadro
     * @param string $boardID - Código do Quadro.
     * @param array $data - Parâmetro em array para os campos. ex.: ['email' => 'john@doe.com', 'type' => 'admin|normal<padrao>|observer', 'fullName' => 'Nome completo'].
     * @return mixed
     * @throws \Exception
     */
    public function inviteMemberInBoard(string $boardID, array $data)
    {
        if(!empty($data)){
            $path = "boards/{$boardID}/members";
            return $this->put($path, $data);
        }
    }

    /**
     * Método responsável por adicionar um membro no quadro
     * @param string $boardID - Código do Quadro
     * @param string $memberID  - Código do Membro
     * @return mixed
     * @throws \Exception
     */
    public function addMemberInBoard(string $boardID, string $memberID)
    {
        $path = "boards/{$boardID}/members/{$memberID}";
        return $this->put($path);
    }


    /**
     * Método responsável por remover um membro do quadro
     * @param string $boardID - Código do Quadro
     * @param string $memberID - Código do Membro do Quadro
     * @return mixed
     */
    public function removeMemberInBoard(string $boardID, string $memberID)
    {
        $path = "boards/{$boardID}/members/{$memberID}";
        return $this->delete($path);
    }


    /*LISTS*/
    /**
     * Método responsável por ler as listas de um quadro especifico
     * @param string $boardID - Parâmetro do ID do Quadro
     * @return array
     */
    public function getListsFromBoard(string $boardID)
    {
        $path = "board/{$boardID}/lists";
        return $this->get($path);
    }

    /**
     * Método responsável por adicionar uma nova lista no quadro
     * @param string $boardID - Parâmetro do ID  do Quadro
     * @param array $data - Parâmetro em array
     * @return mixed
     */
    public function addListsInBoard(string $boardID, array $data)
    {
        $path = "board/{$boardID}/lists";
        return $this->post($path, $data);
    }

    /**
     * Método responsável por atualizar listas no quadro
     * @param string $listID - Código da lista obetidas por getListsFromBoard()
     * @param array $data - Parâmetro de campos a ser atualizados ex. ['name' => 'nome da lista', 'closed' => 'true|false']
     * @return mixed
     * @throws \Exception
     */
    public function updateListsInBoard(string $listID, array $data)
    {
        $path = "lists/{$listID}";
        return $this->put($path, $data);
    }

    /*CARDS*/

    /**
     * Método responsável por pegar os cards de uma lista
     * @param string $listID - código da lista
     * @return array
     */
    public function getCardsFromList(string $listID)
    {
        $path = "lists/{$listID}/cards";
        return $this->get($path);
    }


    /**
     * Método responsável por listar um card especifico de uma lista
     * @param string $cardID - Código do card obtido por getCardsFromList()
     * @return array
     */
    public function getCardFromList(string $cardID)
    {
        $path = "cards/{$cardID}";
        return $this->get($path);
    }

    /**
     * Método responsável por cariar um card dentro de uma lista de um quaddro,
     * @param string $listID - Parâmetro do Código do ID da list obtido por getListsFromBoard()
     * @param array $data - Parâmetro como ['name' => 'Nome do card', 'desc' => 'descricao do card']
     * @return mixed
     */
    public function addCardInList(string $listID, array $data){
        $path = "cards?idList=" . $listID;
        return $this->post($path, $data);
    }

    /**
     * Método responsável por atualizar um card dentro de uma lista de um quaddro,
     * @param string $cardID - Código do Card
     * @param array $data - Parâmetro como ['name' => 'Nome do card', 'desc' => 'descricao do card']
     * @return mixed
     * @throws \Exception
     */
    public function updateCardInList(string  $cardID, array $data)
    {
        $path = "cards/" .$cardID;
        return $this->put($path, $data);
    }

    /**
     * Método responsável por remover card na lista
     * @param string $cardID - Código do card
     * @return mixed
     */
    public function removeCardInList(string $cardID)
    {
        $path = "cards/{$cardID}";
        return $this->delete($path);
    }


    /*Attachments**/

    /**
     * Método responsável por pegar os anexos do card
     * @param string $cardID - Código do Card obtidos por getCardFromList() ou getCardsFromList()
     * @return array
     */
    public function getAttachmentsFromCard(string $cardID)
    {
        $path = "cards/{$cardID}/attachments";
        return $this->get($path);
    }

    /**
     * Método responsável por adicionar um anexo no card
     * @param string $cardID - Código do card obetidos por getCardFromList() ou getCardsFromList()
     * @param array $file - Campo $_FILE['file'] do HTML
     * @param string|null $fileName - Nome do Arquivo a ser Postado
     * @return mixed
     */
    public function addAttachmentsInCard(string $cardID, array $file, string $fileName=null)
    {
        $fileName = empty($fileName) ? $file['name'] : $fileName;
        $data = array('file' => curl_file_create($file['tmp_name'], $file['type'], $fileName));
        $path = "cards/{$cardID}/attachments";
        return $this->postFile($path, $data);
    }

    /**
     * Método responsável por remover um anexo no card
     * @param string $cardID - Código do card
     * @param string $attachmentID - Código do Attachment
     * @return mixed
     */
    public function removeAttachmentsInCard(string $cardID, string $attachmentID)
    {
        $path = "cards/{$cardID}/attachments/{$attachmentID}";
        return $this->delete($path);
    }

    /*Comments**/

    /**
     * Método responsável por adicionar um comentario no card
     * @param string $cardId - Código do Card
     * @param array $data - Um array com os campos ex.: ['text' => 'cometario']
     * @return mixed
     */
    public function addCommentsInCard(string $cardId, array $data)
    {
        $path = "cards/{$cardId}/actions/comments";
        return $this->post($path, $data);
    }

    /**
     * Método responsável por remover um comentario do card
     * @param string $cardID - Código do card
     * @param string $commentsID - Código do Comentario
     * @return mixed
     */
    public function removeCommentsInCard(string $cardID, string $commentsID)
    {
        $path = "cards/{$cardID}/actions/{$commentsID}/comnents";
        return $this->delete($path);
    }


    /**
     * Método responsável por fazer as requisições GET do CURL ( dep. BB_CURL )
     * @param string $path - Parâmetro de parte do caminho para o URI completa do Trello.
     * @return array
     */
    private function get(string  $path)
    {

        $sign = strpos($path, "?") != false  ? '&' : '?';
        $uri =  TRELLO_URI . $path . $sign . 'key=' . $this->key . '&token=' . $this->token;
        $res = (new Request($uri))->withJson()->get()->run()->data();
        return empty($res) ? [] : $res;
    }

    /**
     * Método responsável por fazer as requisições POST do CURL ( dep. BB_CURL )
     * @param string $path - Parâmetro de parte do caminho para o URI completa do Trello.
     * @param array $data - Parâmetro das informações da Query String.
     * @return mixed
     */
    private function post(string $path, array $data){
        if(!empty($data)){
            $sign = strpos($path, "?") != false  ? '&' : '?';
            $query = http_build_query($data);
            $uri = TRELLO_URI . $path . $sign . 'key=' . $this->key . '&token=' . $this->token . '&' . $query;
            $res = (new Request($uri))->withJson()->post()->run()->data();
            return $res;

        }
    }

    /**
     * Método responsável por fazer as requisições POST do CURL ( dep. BB_CURL ) para Arquivos Form-Data
     * @param string $path - Parâmetro de parte do caminho para o URI completa do Trello.
     * @param array $data - Parâmetro das informações  do arquivo Form-Data
     * @return mixed
     */
    private function postFile(string $path, array $data){
        if(!empty($data)){
            $sign = strpos($path, "?") != false  ? '&' : '?';
            $uri = TRELLO_URI . $path . $sign . 'key=' . $this->key . '&token=' . $this->token;
            $res = (new Request($uri))->setHeader("Content-Type", "multipart/form-data")->postFileForm($data)->run()->data();
            return $res;
        }
    }

    /**
     * Método responsável por fazer as requisições PUT do CURL ( dep. BB_CURL )
     * @param string $path - Parâmetro de parte do caminho para o URI completa do Trello.
     * @param array $data - arametro das informações  da Query String.
     * @return mixed
     * @throws \Exception
     */
    private function put(string $path, array $data)
    {

        if(!empty($data)){
            $sign = strpos($path, "?") != false  ? '&' : '?';
            $query = http_build_query($data);
            $uri = TRELLO_URI . $path . $sign .'key=' . $this->key . '&token=' . $this->token . '&' . $query;
            $res = (new Request($uri))->withJson()->put()->run()->data();
            return $res;

        }
    }

    /**
     * Método responsável por fazer as requisições DELETE do CURL ( dep. BB_CURL )
     * @param  string $path - Parâmetro de parte do caminho para o URI completa do Trello.
     * @return mixed
     */
    private function delete(string $path)
    {
            $sign = strpos($path, "?") != false  ? '&' : '?';
            $uri = TRELLO_URI . $path . $sign .'key=' . $this->key . '&token=' . $this->token;
            $res = (new Request($uri))->withJson()->delete()->run()->data();
            return $res;

    }

}