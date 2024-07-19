<?php
class CategoryController extends BaseController
{
    public function view($cate, $subCate = NULL)
    { 
        if (isset($_GET['page'])) $page = intval($_GET['page']);
        else $page = 1;

        $page = ($page > 0) ? $page : 1;
        $limit = 15;
        $offset = ($page - 1) * $limit;

        
        $id="select * from`categories` where alias = '".$cate."'";
        $id=$this->Category->query($id);

        $id=$id[0]['Categorie']['Id'];
        if ($subCate)
{
$subid="select * from`subcategory` where alias = '".$subCate."'";
$subid=$this->Category->query($subid);
$subid=$subid[0]['Subcategory']['Id'];
}              
if($subCate)   $query = "select * from `product`  where SubCategoryId =" . $subid . ' and CategoryId= ' . $id;
else $query = 'select * from `product` where CategoryId= ' . $id;
        $product = $this->Category->query($query);
        $this->set('products', $product);
        $this->set('categoryId',$id);
       if($subCate) $this->set('subCategoryId',$subid);
       else $this->set('subCategoryId',"-1");
    }
}?>
