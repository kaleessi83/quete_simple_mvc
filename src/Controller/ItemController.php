<?php
// src/Controller/ItemController.php
namespace Controller;
use Model\Item;
use Model\ItemManager;
use Twig_Loader_Filesystem;
use Twig_Environment;
class ItemController extends AbstractController
{
    protected $twig;
    public function index()
    {
        $itemManager = new ItemManager($this->pdo);
        $items = $itemManager->selectAll();
        return $this->twig->render('item.html.twig', ['items' => $items]);
    }
    public function show(int $id)
    {
        $itemManager = new ItemManager($this->pdo);
        $item = $itemManager->selectOneById($id);
        return $this->twig->render('items.html.twig', ['item' => $item]);
    }
    public function add()
    {
        $errors=[];
        if (!empty($_POST)) {
            if (!preg_match("/^[a-zA-Z0-9 ]+$/", $_POST['title'])){
                $errors['title'] = 'Veuillez remplir le champ "Titre" uniquement avec des caractères alphanumériques.';
            } else {
                // création d'un nouvel objet Item et hydratation avec les données du formulaire
                $item = new Item();
                $item->setTitle($_POST['title']);
                $itemManager = new ItemManager($this->pdo);
                // l'objet $item hydraté est simplement envoyé en paramètre de insert()
                $itemManager->insert($item);
                // si tout se passe bien, redirection
                header('Location: /');
                exit();
            }
        }
        // le formulaire HTML est affiché (vue à créer)
        return $this->twig->render('item/add.html.twig', ['errors' => $errors]);
    }
    public function edit(int $id)
    {
        $errors=[];
        $itemManager = new ItemManager($this->pdo);
        $item = $itemManager->selectOneById($id);
        if (!empty($_POST)) {
            if (!preg_match("/^[a-zA-Z0-9 ]+$/", $_POST['title'])){
                $errors['title'] = 'Veuillez remplir le champ "Titre" uniquement avec des caractères alphanumériques.';
            } else {
                $itemManager = new ItemManager($this->pdo);
                // l'objet $item hydraté est simplement envoyé en paramètre de insert()
                $itemManager->update($id, $_POST['title']);
                // si tout se passe bien, redirection
                header('Location: /');
                exit();
            }
        }
        return $this->twig->render('item/edit.html.twig', ['item' => $item, 'errors' => $errors]);
    }
    public function delete()
    {
        if (!empty($_POST)) {
            $itemManager = new ItemManager($this->pdo);
            $itemManager->deleteRow($_POST['delete']);
        }
        header('Location: /');
        exit();
    }
}