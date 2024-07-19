<?php
 class FilterController extends BaseController{
   
  public function filter($categoryId=NULL,$subCategoryId=NULL,$name=NULL,$priceFrom=NULL,$priceTo=NULL,$orderby=NULL)
   {  
   if($categoryId)
   {
       if($subCategoryId){
    $query="select * from `product` 
    where CategoryId=".$categoryId." and SubCategoryId = ".$subCategoryId;  }
    else{
        $query="select * from `product` where  CategoryId=".$categoryId;
    }
}
    else{
        $query="select * from `product`";
    }
    
    $listProduct=$this->Filter->query($query);
  
    $newList=[];

    
    if($name!=NULL){
       
        foreach($listProduct as $product){ 
            if(stripos($product['Product']['Name'],$name)!== false){
           
             array_push($newList,$product);
            }
        }
     $listProduct=$newList;
           
     $newList=[];
     }
     
        if($priceFrom){
           foreach($listProduct as $product){
               
               if($product['Product']['Price']*(100-$product['Product']['Percent_off'])/100>=$priceFrom){
              
                array_push($newList,$product);
               }
           }
           $listProduct=$newList;
           
           $newList=[];
        }
        
        if($priceTo){
            
            foreach($listProduct as $product){
                if($product['Product']['Price']*(100-$product['Product']['Percent_off'])/100<=$priceTo){
                
                 array_push($newList,$product);
                }
            }
            $listProduct=$newList;
            $newList=[];
        }
        
        function usortAscending($a, $b) {
            return $a['Product']['Price']*(100-$a['Product']['Percent_off'])/100>$b['Product']['Price']*(100-$b['Product']['Percent_off'])/100;
        }
        function usortDescending($a,$b){
            return $a['Product']['Price']*(100-$a['Product']['Percent_off'])/100<$b['Product']['Price']*(100-$b['Product']['Percent_off'])/100;
        }
        if($orderby==1)
        usort($listProduct, "usortAscending");
        else  usort($listProduct, "usortDescending");
        $this->set('products', $listProduct);
    
   
   }
 public function findName($name){
    
        
     $query="select * from `product` where Name like '%".$name."%'";
    
     $listProduct=$this->Filter->query($query);
         $this->set('products', $listProduct);
        $this->set('search',$name);
     
 }

   function str_contains(string $haystack, string $needle): bool
   {
       return '' === $needle || false !== strpos($haystack, $needle);
   }


}
?>