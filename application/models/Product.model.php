<?php

class Product extends Model
{
    private $productQuantityTable = 'product_quantity';

    function get_one($alias)
    {
        return $this->select_by_alias($alias);
    }
    
    function get_quantity($id, $color, $size)
    {
        $query = "SELECT Quantity FROM " . $this->productQuantityTable . " WHERE ProductId = :id AND Color = :color AND Size = :size";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':color', $color, PDO::PARAM_STR);
        $stmt->bindParam(':size', $size, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? intval($result['Quantity']) : 0;
    }

    function update_quantity($id, $color, $size, $quantity)
    {
        $query = "UPDATE " . $this->productQuantityTable . " SET Quantity = Quantity - :quantity WHERE ProductId = :id AND Color = :color AND Size = :size";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':color', $color, PDO::PARAM_STR);
        $stmt->bindParam(':size', $size, PDO::PARAM_STR);
        $stmt->execute();
    }

    function checkCart()
    {
        $errors = [];
        
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            return "Cart is empty";
        }
        
        foreach ($_SESSION['cart'] as $pid => $item) {
            $left = $this->get_quantity($item['id'], $item['color'], $item['size']);
            if ($item['number'] > $left) {
                $errors[] = "Product " . str_replace("-", " ", $pid) . " only has " . $left . " item(s)";
            }
        }
        
        return $errors;
    }

    function insert_one($data)
    {
        $query = "INSERT INTO " . $this->_table . " (name, CategoryId, SubCategoryId, Description, Price, Color, Material, Size, Createdate, EditDate, isSaleOff, Percent_off, Image1, Image2, Image3, Image4, Alias)
        VALUES (:name, :CategoryId, :SubCategoryId, :Description, :Price, :Color, :Material, :Size, :Createdate, :EditDate, :isSaleOff, :Percent_off, :Image1, :Image2, :Image3, :Image4, :Alias)";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $data['Name'], PDO::PARAM_STR);
        $stmt->bindParam(':CategoryId', $data['CategoryId'], PDO::PARAM_INT);
        $stmt->bindParam(':SubCategoryId', $data['SubCategoryId'], PDO::PARAM_INT);
        $stmt->bindParam(':Description', $data['Description'], PDO::PARAM_STR);
        $stmt->bindParam(':Price', $data['Price'], PDO::PARAM_INT);
        $stmt->bindParam(':Color', $data['Color'], PDO::PARAM_STR);
        $stmt->bindParam(':Material', $data['Material'], PDO::PARAM_STR);
        $stmt->bindParam(':Size', $data['Size'], PDO::PARAM_STR);
        $stmt->bindParam(':Createdate', date("Y-m-d"), PDO::PARAM_STR);
        $stmt->bindParam(':EditDate', date("Y-m-d"), PDO::PARAM_STR);
        $stmt->bindParam(':isSaleOff', isset($data['isSaleOff']) ? 1 : 0, PDO::PARAM_INT);
        $stmt->bindParam(':Percent_off', $data['Percent_off'], PDO::PARAM_INT);
        $stmt->bindParam(':Image1', $data['Image1'], PDO::PARAM_STR);
        $stmt->bindParam(':Image2', $data['Image2'], PDO::PARAM_STR);
        $stmt->bindParam(':Image3', $data['Image3'], PDO::PARAM_STR);
        $stmt->bindParam(':Image4', $data['Image4'], PDO::PARAM_STR);
        $stmt->bindParam(':Alias', $data['Alias'], PDO::PARAM_STR);
        $stmt->execute();

        $lastId = $this->db->lastInsertId();

        
        $queryQty = "INSERT INTO " . $this->productQuantityTable . " (ProductId, Color, Size, Quantity) VALUES (:ProductId, :Color, :Size, :Quantity)";
        $stmtQty = $this->db->prepare($queryQty);
        $stmtQty->bindParam(':ProductId', $lastId, PDO::PARAM_INT);
        $stmtQty->bindParam(':Color', $data['Color'], PDO::PARAM_STR);
        $stmtQty->bindParam(':Size', $data['Size'], PDO::PARAM_STR);
        $stmtQty->bindParam(':Quantity', $data['Quantity'], PDO::PARAM_INT);
        $stmtQty->execute();
    }

    function update_one($data)
    {
        $query = "UPDATE " . $this->_table . " SET 
        Description = :Description,
        Price = :Price,
        Material = :Material,
        Percent_off = :Percent_off,
        Image1 = :Image1,
        Image2 = :Image2,
        Image3 = :Image3,
        Image4 = :Image4
        WHERE id = :id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':Description', $data['Description'], PDO::PARAM_STR);
        $stmt->bindParam(':Price', $data['Price'], PDO::PARAM_INT);
        $stmt->bindParam(':Material', $data['Material'], PDO::PARAM_STR);
        $stmt->bindParam(':Percent_off', $data['Percent_off'], PDO::PARAM_INT);
        $stmt->bindParam(':Image1', $data['Image1'], PDO::PARAM_STR);
        $stmt->bindParam(':Image2', $data['Image2'], PDO::PARAM_STR);
        $stmt->bindParam(':Image3', $data['Image3'], PDO::PARAM_STR);
        $stmt->bindParam(':Image4', $data['Image4'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $data['Id'], PDO::PARAM_INT);
        $stmt->execute();

        
        $queryQty = "UPDATE " . $this->productQuantityTable . " SET 
        Quantity = :Quantity
        WHERE ProductId = :ProductId AND Color = :Color AND Size = :Size";
        
        $stmtQty = $this->db->prepare($queryQty);
        $stmtQty->bindParam(':Quantity', $data['Quantity'], PDO::PARAM_INT);
        $stmtQty->bindParam(':ProductId', $data['Id'], PDO::PARAM_INT);
        $stmtQty->bindParam(':Color', $data['Color'], PDO::PARAM_STR);
        $stmtQty->bindParam(':Size', $data['Size'], PDO::PARAM_STR);
        $stmtQty->execute();
    }

    function page($offset, $limit)
    {
        $query = "SELECT * FROM " . $this->_table . " LIMIT :offset, :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getTotal()
    {
        $query = "SELECT COUNT(*) as total FROM " . $this->_table;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function decrementStock($productId, $color, $size, $quantity) {
        $query = "UPDATE " . $this->productQuantityTable . " SET Quantity = Quantity - :quantity WHERE ProductId = :product_id AND Color = :color AND Size = :size";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':color', $color, PDO::PARAM_STR);
        $stmt->bindParam(':size', $size, PDO::PARAM_STR);
        $stmt->execute();
    }
}

?>
