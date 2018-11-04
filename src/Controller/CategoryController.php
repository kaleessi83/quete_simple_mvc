<?php
// src/Controller/CategoryController.php
namespace Controller;
use Model\CategoryManager;
use Twig_Loader_Filesystem;
use Twig_Environment;
class CategoryController extends AbstractController
{
    private $twig;
    public function index()
    {
        $categoryManager=new CategoryManager($this->pdo);
        $categories=$categoryManager->selectAll();
        return $this->twig->render('categories.html.twig', ['categories' => $categories]);
    }
    public function show(int $id)
    {
        $categoryManager=new CategoryManager($this->pdo);
        $category=$categoryManager->selectOneById($id);
        return $this->twig->render('category.html.twig', ['category' => $category]);
    }
}