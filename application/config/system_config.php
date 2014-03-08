<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * System configuration
 * 
 * @author Chaitenya yadav
 * 
 */
$config['site_title']					= 'Product Duniya Control Panel';
$config['copyright']                                    = 'Copyrights '.date("Y").' @ Product Duniya';
$config['controlPanelCopyright']                        = 'Garigy, all rights reserved.';
$config['controlPanel']					= 'admin';
$config['controlPanelTitle']				= 'Product Duniya';
$config['dump_path']					= './mysqldump/';
$config['themeCode']                                    = 'pdw';
$config['adminProfileId']				= '1';
$config['storeOwnerProfileId']				= '2';

$config['homePageProductCount']				= '5';
$config['productPerPageCount']                          = '4';

$config['defaultCity']  				= '1';

$config['pageTitle']					= ' :: productduniya.com';
$config['metaKeyword']					= 'metaKeyword';
$config['metaDesc']					= 'metaDesc';

$config['sortBy'] = 'price';
$config['sortDirection'] = 'asc';

$config['productImgPath'] = '/uploads/products/'; // Product image of original size.
$config['productThumbImgPath'] = '/uploads/products/thumbnails/';
$config['productStampImgPath'] = '/uploads/products/stamp/';
$config['productLargeImgPath'] = '/uploads/products/large/'; // Product image for product detail page
$config['defaultMainImg'] = 'noImage.png';
$config['storeLogoPath']='/uploads/stores/';
$config['brandImgPath'] = './uploads/brands/';
$config['tempXls'] = './uploads/excels/temp/';
$config['pathToXls'] = '/uploads/excels/temp/';
$config['xlsCongif'] = array('product-specification.xls'=> array("function" => "uploadProdSpecXLS", "fields" => array("productid"=>"productId","group"=>"groupId","speclabel"=>"specLabel","specvalue"=>"specValue")), 'products-master.xls'=> array("function" => "uploadProdMasterXLS", "fields" => array("product-sku"=>"productSKU", "brand-id"=>"brandId", "product-model-no"=>"productModel", "product-name"=>"productName", "product-varient"=>"productVariant", "product-color"=>"productColor", "product-description"=>"productDesc", "product-mrp"=>"productMRP", "product-dp"=>"productDP", "product-features"=>"productFeatures", "category-id"=>"categoryId", "page-title"=>"pageTitle", "meta-keyword"=>"metaKeyword", "meta-desc"=>"metaDesc")));
$config['bannerUploadPath']='uploads/banners';

$config['pd_gplus'] = 'https://plus.google.com/101473748875611918148/posts';
$config['pd_youtube'] = 'https://www.youtube.com';
$config['pd_pint'] = 'http://www.pinterest.com/productduniya/';
$config['pd_twitter'] = 'https://twitter.com/ProductDuniya';
$config['pd_linkedin'] = 'https://www.linkedin.com';
$config['pd_fb'] = 'https://www.facebook.com/ProductDuniya';
$config['bannerPositions']=array('front1'=>'front1','front2'=>'front2','front3'=>'front3','front4'=>'front4');

/* End of file config.php */
/* Location: ./application/config/config.php */
