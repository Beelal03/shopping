<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
    <section class="main">
    <div class="cart">
    <div class="header"> 
                <p>Shopping Cart</p>
            </div>
      <div class="productListing">
      <?php




// Create connection

function dbConnection(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cart";

  // create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  return $conn;
}


function getItems(){
  $conn = dbConnection();
  $sql = "SELECT * FROM mydata";
  $result = $conn->query($sql);
  return $result;
}





    class item{
      private $name;
      private $price;
      private $image;
      private $id;
      private $quantity;

      public function __construct($item){
        $this->name=$item['item_name'];
        $this->price=$item['item_price'];
        $this->image=$item['item_img'];
        $this->quantity=$item['item_quantity'];
        $this->id=$item['Id_item'];
      }

      function createTemplate($item)
      {
        $dbImageURL = $item->getImageURL();
      
        echo <<< TEMPLATE
        <div class="item1">
        <div class="img">
            <img src="assests/$dbImageURL">
        </div>
        <div class="details">
            <h3>{$this->getName()}</h3><br>
            <p>250ml</p>
        </div>
        <div class="num">
            <button class="btn" data-product-type ={$this->getId()}>+</button> <p>{$this->getQuantity()}</p> <button class="btn" data-product-type ={$this->getId()}>-</button>
        </div>
        <div class="end">
            <p>{$this->getPrice()}</p>
          <button>  <p>Save for later</p></button>
            <button><p>remove</p></button>
        </div>
        </div>
        
        TEMPLATE;
      }
      

      // public function setName($name){
      //   $this->name=$name;
      // }
      // public function setPrice($price){
      //   $this->price=$price;
      // }
      // public function setImage($imageURL){
      //   $this->image=$imageURL;
      // }
      // public function setId(){
      //   static $id=1;
      //   $this->id=$id;
      //   $id++;
      // }
      // public function setQuantity($quantity){
      //    $this->quantity=$quantity;
      // }

      // public function getId(){
      //   return $this->id;
      // }
      public function updateItem($name,$price,$quantity,$imageURL){

      }
      // public function createItem($name,$price,$quantity,$imageURL){

      //    $conn = dbConnection();
      //   $this->setId();
      //   $mySqlId= $this->getId(); 
      //   $sql = "SELECT * FROM mydata WHERE Id_item = $mySqlId ";
      //   $result = $conn->query($sql);
        
      //           // echo $result;
      //   if (true) {  
      //   $sql = "UPDATE mydata SET item_name='fish' WHERE id=1 ";  
      //   $result2 = $conn->query($sql);      
      //     // $row2 =$result2->fetch_assoc();
      //     // $this->setName($row2["item_name"]);
      //     echo $result2;
      //   // output data of each row
      //   // while($row = $result->fetch_assoc()) {
      //     $row =$result->fetch_assoc();
      //     $this->setName($row["item_name"]);
      //   $this->setPrice( $row["item_price"]);
      //   $this->setImage($row["item_img"]);
      //   $this->setQuantity($row["item_quantity"]);
          
      //         // echo "id: " . $row["Id_item"]. " - Name: " . . " " .. " " . "<br>";
      //   // }
      //     } else {
      //           echo "0 results";
      //     }

      //   $conn->close();       
      // }
      
      public function getName(){
        return $this->name;
      }
      public function getPrice(){
        return $this->price;
      }
      public function getImageURL(){
        return $this->image;
      }
      public function getQuantity(){
        return $this->quantity;
      }
      public function getId(){
        return $this->id;
      }

    }
    // $item1=new item(name, price);
    // $item1->createItem("","","","");
    // $item1->createTemplate();
    

    // $item2= new item();
    // $item2->createItem("","","","");
    // $item2->createTemplate();
  
     

$item_list = getItems(); 
if ($item_list->num_rows > 0) {
  // output data of each row
  while($row = $item_list->fetch_assoc()) {
    $item= new item($row);
    // echo $item->getId();
    echo $item->createTemplate($item);
    // echo "id: " . $row["Id_item"]. "" . $row["item_name"]. " " . $row["item_img"].  $row["item_quantity"]. $row["item_price"]. "<br>";
  }
} else {
  echo "0 results";
}


?>
<div class="total">
                    <h3>Sub-total</h3>
                    <p>2 Items</p>
                </div>
      </div>
    </div>
</section>
<script>
  let cart = [];
  document.querySelector(".productListing").addEventListener("click",function(e){
    console.log(e.target.textContent)
    let target = e.target
    console.log(target.getAttribute("data-product-type"))
    if(e.target.textContent === "+"){
      cart.push(target.getAttribute("data-product-type"))
    
    }
    else if(e.target.textContent === "-"){
      let index = 0;
      while(cart.length != 0 && index < cart.length){
        if(cart[index] === target.getAttribute("data-product-type")){
          cart.splice(index, 1)
        }
        index++;
      }
    }
    console.log(cart)
  })
</script>
</body>
</html>