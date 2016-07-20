<?php
/***
* 設定
***/
$dir = "./img/output/";
$imgNum = count(glob($dir . "*.png")); //ディレクトリ内のPNG数を取得


/***
* 画像保存処理
***/
//canvasデータがPOSTで送信されてきた場合
if(isset($_POST['canvasImage'])){
    $canvas = $_POST['canvasImage'];

    //ヘッダに「data:image/png;base64,」が付いているので、それは外す
    $canvas = preg_replace("/data:[^,]+,/i", '', $canvas);

    //残りのデータはbase64エンコードされているので、デコードする
    $canvas = base64_decode($canvas);

    //まだ文字列の状態なので、画像リソース化
    $image = imagecreatefromstring($canvas);

    //画像として保存（ディレクトリは任意）
    imagesavealpha($image, TRUE); // 透明色の有効
    imagepng($image , $dir . 'img' . ($imgNum + 1) . '.png');

    echo ($imgNum + 1) . ',' . $dir . 'img' . ($imgNum + 1) . '.png';
} else if($_SERVER["REQUEST_METHOD"] == "GET"){
    echo $imgNum;
}

?>
