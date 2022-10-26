<?php

namespace App\Http\Controllers\Admin;

use App\{
    Models\Product,
    Models\Gallery,
    Models\Category,
    Models\Currency,
    Models\Attribute,
    Models\Subcategory,
    Models\Childcategory,
    Models\AttributeOption
};
use Illuminate\{
    Http\Request,
    Support\Str
};
use App\Http\Controllers\Controller;
use DB;
use Image;
use Validator;


class ProductController extends Controller
{
  
    public function index(){
        return view('admin.product.index');
    }

    public function productsettings(){
        return view('admin.product.settings');
    }


    //*** GET Request
    public function create($slug)
    {
        $cats = Category::all();
        $sign = $this->curr;
        
        if($slug == 'physical'){
            return view('admin.product.create',compact('cats','sign'));
        }
    }

    //*** GET Request
    public function status($id1,$id2)
    {
        $data = Product::findOrFail($id1);
        $data->status = $id2;
        $data->update();
        //--- Redirect Section
        $msg = __('Status Updated Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }



    //*** POST Request
    public function uploadUpdate(Request $request,$id)
    {

        //--- Validation Section
        $rules = [
          'image' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = Product::findOrFail($id);

        //--- Validation Section Ends
        $image = $request->image;
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name = time().Str::random(8).'.png';
        $path = 'assets/images/products/'.$image_name;
        file_put_contents($path, $image);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/products/'.$data->photo)) {
                        unlink(public_path().'/assets/images/products/'.$data->photo);
                    }
                }
                        $input['photo'] = $image_name;
         $data->update($input);
                if($data->thumbnail != null)
                {
                    if (file_exists(public_path().'/assets/images/thumbnails/'.$data->thumbnail)) {
                        unlink(public_path().'/assets/images/thumbnails/'.$data->thumbnail);
                    }
                }

        $img = Image::make(public_path().'/assets/images/products/'.$data->photo)->resize(285, 285);
        $thumbnail = time().Str::random(8).'.jpg';
        $img->save(public_path().'/assets/images/thumbnails/'.$thumbnail);
        $data->thumbnail  = $thumbnail;
        $data->update();
        return response()->json(['status'=>true,'file_name' => $image_name]);
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
            'photo'      => 'required',
            'file'       => 'mimes:zip'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Product;
        $sign = $this->curr;
        $input = $request->all();

        // Check File
        if ($file = $request->file('file')) {
            $name = time().\Str::random(8).str_replace(' ', '', $file->getClientOriginalExtension());
            $file->move('assets/files',$name);
            $input['file'] = $name;
        }

        $image = $request->photo;
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name = time().Str::random(8).'.png';
        $path = 'assets/images/products/'.$image_name;
        file_put_contents($path, $image);
        $input['photo'] = $image_name;

        // Check Physical
        if($request->type == "Physical")
        {
            //--- Validation Section
            $rules = ['sku'      => 'min:8|unique:products'];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }
            //--- Validation Section Ends

            // Check Condition
            if ($request->product_condition_check == ""){
                $input['product_condition'] = 0;
            }

            // Check Minimum Qty
            if ($request->minimum_qty_check == ""){
                $input['minimum_qty'] = null;
            }

            // Check Shipping Time
            if ($request->shipping_time_check == ""){
                $input['ship'] = null;
            }

            // Check Size
            if(empty($request->stock_check ))
            {
                $input['stock_check'] = 0;
                $input['size'] = null;
                $input['size_qty'] = null;
                $input['size_price'] = null;
                $input['color'] = null;
            }
            else{
                    if(in_array(null, $request->size) || in_array(null, $request->size_qty) || in_array(null, $request->size_price))
                    {
                        $input['stock_check'] = 0;
                        $input['size'] = null;
                        $input['size_qty'] = null;
                        $input['size_price'] = null;
                        $input['color'] = null;
                    }
                    else
                    {
                        $input['stock_check'] = 1;
                        $input['color'] = implode(',', $request->color);
                        $input['size'] = implode(',', $request->size);
                        $input['size_qty'] = implode(',', $request->size_qty);
                        $size_prices = $request->size_price;
                        $s_price = array();
                        foreach($size_prices as $key => $sPrice){
                            $s_price[$key] = $sPrice / $sign->value;
                        }

                        $input['size_price'] = implode(',', $s_price);
                    }
            }

            // Check Color
            if(empty($request->color_check))
            {
                $input['color_all'] = null;
            }
            else{
                $input['color_all'] = implode(',', $request->color_all);
            }
            // Check Size
            if(empty($request->size_check))
            {
                $input['size_all'] = null;
            }
            else{
                $input['size_all'] = implode(',', $request->size_all);
            }

            // Check Color
            if(empty($request->color_check))
            {
                $input['color'] = null;
            }
            else{
                $input['color'] = implode(',', $request->color);
            }

            // Check Measurement
            if ($request->mesasure_check == "")
            {
                $input['measure'] = null;
            }

        }

        // Check Seo
        if (empty($request->seo_check))
        {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;
        }
        else {
            if (!empty($request->meta_tag))
            {
                $input['meta_tag'] = implode(',', $request->meta_tag);
            }
        }

        // Check Features
        if(in_array(null, $request->features) || in_array(null, $request->colors))
        {
            $input['features'] = null;
            $input['colors'] = null;
        }
        else
        {
            $input['features'] = implode(',', str_replace(',',' ',$request->features));
            $input['colors'] = implode(',', str_replace(',',' ',$request->colors));
        }

        //tags
        if (!empty($request->tags))
        {
            $input['tags'] = implode(',', $request->tags);
        }

        // Conert Price According to Currency
        $input['price'] = ($input['price'] / $sign->value);
        $input['previous_price'] = ($input['previous_price'] / $sign->value);

        // store filtering attributes for physical product
        $attrArr = [];
        if (!empty($request->category_id)) {
          $catAttrs = Attribute::where('attributable_id', $request->category_id)->where('attributable_type', 'App\Models\Category')->get();
          if (!empty($catAttrs)) {
            foreach ($catAttrs as $key => $catAttr) {
              $in_name = $catAttr->input_name;
              if ($request->has("$in_name")) {
                $attrArr["$in_name"]["values"] = $request["$in_name"];
                $attrArr["$in_name"]["prices"] = $request["$in_name"."_price"];
                if ($catAttr->details_status) {
                  $attrArr["$in_name"]["details_status"] = 1;
                } else {
                  $attrArr["$in_name"]["details_status"] = 0;
                }
              }
            }
          }
        }

        if (!empty($request->subcategory_id)) {
          $subAttrs = Attribute::where('attributable_id', $request->subcategory_id)->where('attributable_type', 'App\Models\Subcategory')->get();
          if (!empty($subAttrs)) {
            foreach ($subAttrs as $key => $subAttr) {
              $in_name = $subAttr->input_name;
              if ($request->has("$in_name")) {
                $attrArr["$in_name"]["values"] = $request["$in_name"];
                $attrArr["$in_name"]["prices"] = $request["$in_name"."_price"];
                if ($subAttr->details_status) {
                  $attrArr["$in_name"]["details_status"] = 1;
                } else {
                  $attrArr["$in_name"]["details_status"] = 0;
                }
              }
            }
          }
        }

        if (!empty($request->childcategory_id)) {
          $childAttrs = Attribute::where('attributable_id', $request->childcategory_id)->where('attributable_type', 'App\Models\Childcategory')->get();
          if (!empty($childAttrs)) {
            foreach ($childAttrs as $key => $childAttr) {
              $in_name = $childAttr->input_name;
              if ($request->has("$in_name")) {
                $attrArr["$in_name"]["values"] = $request["$in_name"];
                $attrArr["$in_name"]["prices"] = $request["$in_name"."_price"];
                if ($childAttr->details_status) {
                  $attrArr["$in_name"]["details_status"] = 1;
                } else {
                  $attrArr["$in_name"]["details_status"] = 0;
                }
              }
            }
          }
        }

        if (empty($attrArr)) {
          $input['attributes'] = NULL;
        } else {
          $jsonAttr = json_encode($attrArr);
          $input['attributes'] = $jsonAttr;
        }

        // Save Data
        $data->fill($input)->save();

        // Set SLug
        $prod = Product::find($data->id);
        if($prod->type != 'Physical'){
            $prod->slug = Str::slug($data->name,'-').'-'.strtolower(Str::random(3).$data->id.Str::random(3));
        }
        else {
            $prod->slug = Str::slug($data->name,'-').'-'.strtolower($data->sku);
        }

        // Set Thumbnail
        $img = Image::make(public_path().'/assets/images/products/'.$prod->photo)->resize(285, 285);
        $thumbnail = time().Str::random(8).'.jpg';
        $img->save(public_path().'/assets/images/thumbnails/'.$thumbnail);
        $prod->thumbnail  = $thumbnail;
        $prod->update();

        // Add To Gallery If any
        $lastid = $data->id;
        if ($files = $request->file('gallery')){
            foreach ($files as  $key => $file){
                if(in_array($key, $request->galval))
                {
                    $gallery = new Gallery;
                    $name = time().\Str::random(8).str_replace(' ', '', $file->getClientOriginalExtension());
                    $file->move('assets/images/galleries',$name);
                    $gallery['photo'] = $name;
                    $gallery['product_id'] = $lastid;
                    $gallery->save();
                }
            }
        }
        //logic Section Ends

        //--- Redirect Section
        $msg = __("New Product Added Successfully.").'<a href="'.route('admin-prod-index').'">'.__("View Product Lists.").'</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** GET Request
    public function import(){

        $cats = Category::all();
        $sign = $this->curr;
        return view('admin.product.productcsv',compact('cats','sign'));
    }

    //*** POST Request
    public function importSubmit(Request $request)
    {
        $log = "";
        //--- Validation Section
        $rules = [
            'csvfile'      => 'required|mimes:csv,txt',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $filename = '';
        if ($file = $request->file('csvfile'))
        {
            $filename = time().'-'.$file->getClientOriginalExtension();
            $file->move('assets/temp_files',$filename);
        }

        $datas = "";

        $file = fopen(public_path('assets/temp_files/'.$filename),"r");
        $i = 1;

        while (($line = fgetcsv($file)) !== FALSE) {

            if($i != 1)
            {

            if (!Product::where('sku',$line[0])->exists()){
                //--- Validation Section Ends

                //--- Logic Section
                $data = new Product;
                $sign = Currency::where('is_default','=',1)->first();

                $input['type'] = 'Physical';
                $input['sku'] = $line[0];

                $input['category_id'] = null;
                $input['subcategory_id'] = null;
                $input['childcategory_id'] = null;

                $mcat = Category::where(DB::raw('lower(name)'), strtolower($line[1]));
                //$mcat = Category::where("name", $line[1]);

                if($mcat->exists()){
                    $input['category_id'] = $mcat->first()->id;

                    if($line[2] != ""){
                        $scat = Subcategory::where(DB::raw('lower(name)'), strtolower($line[2]));

                        if($scat->exists()) {
                            $input['subcategory_id'] = $scat->first()->id;
                        }
                    }
                    if($line[3] != ""){
                        $chcat = Childcategory::where(DB::raw('lower(name)'), strtolower($line[3]));

                        if($chcat->exists()) {
                            $input['childcategory_id'] = $chcat->first()->id;
                        }
                    }

                $input['photo'] = $line[5];
                $input['name'] = $line[4];
                $input['details'] = $line[6];
                $input['color'] = $line[13];
                $input['price'] = $line[7];
                $input['previous_price'] = $line[8] != "" ? $line[8] : null;
                $input['stock'] = $line[9];
                $input['size'] = $line[10];
                $input['size_qty'] = $line[11];
                $input['size_price'] = $line[12];
                $input['youtube'] = $line[15];
                $input['policy'] = $line[16];
                $input['meta_tag'] = $line[17];
                $input['meta_description'] = $line[18];
                $input['tags'] = $line[14];
                $input['product_type'] = $line[19];
                $input['affiliate_link'] = $line[20];
                $input['slug'] = Str::slug($input['name'],'-').'-'.strtolower($input['sku']);

                $image_url = $line[5];

                $ch = curl_init();
                curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt ($ch, CURLOPT_URL, $image_url);
                curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 20);
                curl_setopt ($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_NOBODY, true);

                $content = curl_exec ($ch);
                $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

                $thumb_url = '';

                if (strpos($contentType, 'image/') !== false) {
                    $fimg = Image::make($line[5])->resize(800, 800);
                    $fphoto = time().Str::random(8).'.jpg';
                    $fimg->save(public_path().'/assets/images/products/'.$fphoto);
                    $input['photo']  = $fphoto;
                    $thumb_url = $line[5];
                }else{
                    $fimg = Image::make(public_path().'/assets/images/noimage.png')->resize(800, 800);
                    $fphoto = time().Str::random(8).'.jpg';
                    $fimg->save(public_path().'/assets/images/products/'.$fphoto);
                    $input['photo']  = $fphoto;
                    $thumb_url = public_path().'/assets/images/noimage.png';
                }

                $timg = Image::make($thumb_url)->resize(285, 285);
                $thumbnail = time().Str::random(8).'.jpg';
                $timg->save(public_path().'/assets/images/thumbnails/'.$thumbnail);
                $input['thumbnail']  = $thumbnail;

                // Conert Price According to Currency
                $input['price'] = ($input['price'] / $sign->value);
                $input['previous_price'] = ($input['previous_price'] / $sign->value);

                // Save Data
                $data->fill($input)->save();

                    }else{
                        $log .= "<br>".__('Row No').": ".$i." - ".__('No Category Found!')."<br>";
                    }

                }else{
                    $log .= "<br>".__('Row No').": ".$i." - ".__('Duplicate Product Code!')."<br>";
                }
            }

            $i++;
        }
        fclose($file);

        //--- Redirect Section
        $msg = __('Bulk Product File Imported Successfully.').$log;
        return response()->json($msg);
    }

    //*** GET Request
    public function edit($id)
    {
        $cats = Category::all();
        $data = Product::findOrFail($id);
        $sign = $this->curr;

        return view('admin.product.edit',compact('cats','data','sign'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
      // return $request;
        //--- Validation Section
        $rules = [
               'file'       => 'mimes:zip'
                ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //-- Logic Section
        $data = Product::findOrFail($id);
        $sign = $this->curr;
        $input = $request->all();

            //Check Types
            if($request->type_check == 1)
            {
                $input['link'] = null;
            }
            else
            {
                if($data->file!=null){
                        if (file_exists(public_path().'/assets/files/'.$data->file)) {
                        unlink(public_path().'/assets/files/'.$data->file);
                    }
                }
                $input['file'] = null;
            }

            // Check Physical
            if($data->type == "Physical")
            {
            //--- Validation Section
            $rules = ['sku' => 'min:8|unique:products,sku,'.$id];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }
            //--- Validation Section Ends

            // Check Condition
            if ($request->product_condition_check == ""){
                $input['product_condition'] = 0;
            }

            // Check Minimum Qty
            if ($request->minimum_qty_check == ""){
            $input['minimum_qty'] = null;
            }

            // Check Shipping Time
            if ($request->shipping_time_check == ""){
                $input['ship'] = null;
            }

            // Check Size
            if(empty($request->stock_check ))
            {
                $input['stock_check'] = 0;
                $input['size'] = null;
                $input['size_qty'] = null;
                $input['size_price'] = null;
                $input['color'] = null;
            } else {
                    if(in_array(null, $request->size) || in_array(null, $request->size_qty) || in_array(null, $request->size_price))
                    {
                        $input['stock_check'] = 0;
                        $input['size'] = null;
                        $input['size_qty'] = null;
                        $input['size_price'] = null;
                        $input['color'] = null;
                    }
                    else
                    {
                        $input['stock_check'] = 1;
                        $input['color'] = implode(',', $request->color);
                        $input['size'] = implode(',', $request->size);
                        $input['size_qty'] = implode(',', $request->size_qty);
                        $size_prices = $request->size_price;
                        $s_price = array();
                        foreach($size_prices as $key => $sPrice){
                            $s_price[$key] = $sPrice / $sign->value;
                        }

                        $input['size_price'] = implode(',', $s_price);
                    }
            }

            // Check Color
            if(empty($request->color_check))
            {
                $input['color_all'] = null;
            }
            else{
                $input['color_all'] = implode(',', $request->color_all);
            }

            // Check Size
            if(empty($request->size_check))
            {
                $input['size_all'] = null;
            }
            else{
                $input['size_all'] = implode(',', $request->size_all);
            }

            // Check Seo
        if (empty($request->seo_check))
         {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;
         }
         else {
            if (!empty($request->meta_tag))
            {
                $input['meta_tag'] = implode(',', $request->meta_tag);
            }
         }


        // Check License
        if($data->type == "License")
        {

        if(!in_array(null, $request->license) && !in_array(null, $request->license_qty))
        {
            $input['license'] = implode(',,', $request->license);
            $input['license_qty'] = implode(',', $request->license_qty);
        }
        else
        {
            if(in_array(null, $request->license) || in_array(null, $request->license_qty))
            {
                $input['license'] = null;
                $input['license_qty'] = null;
            }
            else
            {
                $license = explode(',,', $data->license);
                $license_qty = explode(',', $data->license_qty);
                $input['license'] = implode(',,', $license);
                $input['license_qty'] = implode(',', $license_qty);
            }
        }

        }
            // Check Features
            if(!in_array(null, $request->features) && !in_array(null, $request->colors))
            {
                    $input['features'] = implode(',', str_replace(',',' ',$request->features));
                    $input['colors'] = implode(',', str_replace(',',' ',$request->colors));
            }
            else
            {
                if(in_array(null, $request->features) || in_array(null, $request->colors))
                {
                    $input['features'] = null;
                    $input['colors'] = null;
                }
                else
                {
                    $features = explode(',', $data->features);
                    $colors = explode(',', $data->colors);
                    $input['features'] = implode(',', $features);
                    $input['colors'] = implode(',', $colors);
                }
            }

        //Product Tags
        if (!empty($request->tags))
         {
            $input['tags'] = implode(',', $request->tags);
         }
        if (empty($request->tags))
         {
            $input['tags'] = null;
         }

         $input['price'] = $input['price'] / $sign->value;
         $input['previous_price'] = $input['previous_price'] / $sign->value;

         // store filtering attributes for physical product
         $attrArr = [];
         if (!empty($request->category_id)) {
           $catAttrs = Attribute::where('attributable_id', $request->category_id)->where('attributable_type', 'App\Models\Category')->get();
           if (!empty($catAttrs)) {
             foreach ($catAttrs as $key => $catAttr) {
               $in_name = $catAttr->input_name;
               if ($request->has("$in_name")) {
                 $attrArr["$in_name"]["values"] = $request["$in_name"];
                 $attrArr["$in_name"]["prices"] = $request["$in_name"."_price"];
                 if ($catAttr->details_status) {
                   $attrArr["$in_name"]["details_status"] = 1;
                 } else {
                   $attrArr["$in_name"]["details_status"] = 0;
                 }
               }
             }
           }
         }

         if (!empty($request->subcategory_id)) {
           $subAttrs = Attribute::where('attributable_id', $request->subcategory_id)->where('attributable_type', 'App\Models\Subcategory')->get();
           if (!empty($subAttrs)) {
             foreach ($subAttrs as $key => $subAttr) {
               $in_name = $subAttr->input_name;
               if ($request->has("$in_name")) {
                 $attrArr["$in_name"]["values"] = $request["$in_name"];
                 $attrArr["$in_name"]["prices"] = $request["$in_name"."_price"];
                 if ($subAttr->details_status) {
                   $attrArr["$in_name"]["details_status"] = 1;
                 } else {
                   $attrArr["$in_name"]["details_status"] = 0;
                 }
               }
             }
           }
         }
         if (!empty($request->childcategory_id)) {
           $childAttrs = Attribute::where('attributable_id', $request->childcategory_id)->where('attributable_type', 'App\Models\Childcategory')->get();
           if (!empty($childAttrs)) {
             foreach ($childAttrs as $key => $childAttr) {
               $in_name = $childAttr->input_name;
               if ($request->has("$in_name")) {
                 $attrArr["$in_name"]["values"] = $request["$in_name"];
                 $attrArr["$in_name"]["prices"] = $request["$in_name"."_price"];
                 if ($childAttr->details_status) {
                   $attrArr["$in_name"]["details_status"] = 1;
                 } else {
                   $attrArr["$in_name"]["details_status"] = 0;
                 }
               }
             }
           }
         }

         if (empty($attrArr)) {
           $input['attributes'] = NULL;
         } else {
           $jsonAttr = json_encode($attrArr);
           $input['attributes'] = $jsonAttr;
         }

         $data->slug = Str::slug($data->name,'-').'-'.strtolower($data->sku);

         $data->update($input);
        //-- Logic Section Ends

        //--- Redirect Section
        $msg = __("Product Updated Successfully.").'<a href="'.route('admin-prod-index').'">'.__("View Product Lists.").'</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** GET Request
    public function feature($id)
    {
            $data = Product::findOrFail($id);
            return view('admin.product.highlight',compact('data'));
    }

    //*** POST Request
    public function featuresubmit(Request $request, $id)
    {
        //-- Logic Section
            $data = Product::findOrFail($id);
            $input = $request->all();
            if($request->featured == "")
            {
                $input['featured'] = 0;
            }
            if($request->hot == "")
            {
                $input['hot'] = 0;
            }
            if($request->best == "")
            {
                $input['best'] = 0;
            }
            if($request->top == "")
            {
                $input['top'] = 0;
            }
            if($request->latest == "")
            {
                $input['latest'] = 0;
            }
            if($request->big == "")
            {
                $input['big'] = 0;
            }
            if($request->trending == "")
            {
                $input['trending'] = 0;
            }
            if($request->sale == "")
            {
                $input['sale'] = 0;
            }
            if($request->is_discount == "")
            {
                $input['is_discount'] = 0;
                $input['discount_date'] = null;
            }else{
                $input['discount_date'] = \Carbon\Carbon::parse($input['discount_date'])->format('Y-m-d');
            }

            $data->update($input);
        //-- Logic Section Ends

        //--- Redirect Section
        $msg = __('Highlight Updated Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends

    }

    //*** GET Request
    public function destroy($id)
    {

        $data = Product::findOrFail($id);
        if($data->galleries->count() > 0)
        {
            foreach ($data->galleries as $gal) {
                    if (file_exists(public_path().'/assets/images/galleries/'.$gal->photo)) {
                        unlink(public_path().'/assets/images/galleries/'.$gal->photo);
                    }
                $gal->delete();
            }

        }

        if($data->reports->count() > 0)
        {
            foreach ($data->reports as $gal) {
                $gal->delete();
            }
        }

        if($data->ratings->count() > 0)
        {
            foreach ($data->ratings  as $gal) {
                $gal->delete();
            }
        }
        if($data->wishlists->count() > 0)
        {
            foreach ($data->wishlists as $gal) {
                $gal->delete();
            }
        }
        if($data->clicks->count() > 0)
        {
            foreach ($data->clicks as $gal) {
                $gal->delete();
            }
        }
        if($data->comments->count() > 0)
        {
            foreach ($data->comments as $gal) {
            if($gal->replies->count() > 0)
            {
                foreach ($gal->replies as $key) {
                    $key->delete();
                }
            }
                $gal->delete();
            }
        }

        if (!filter_var($data->photo,FILTER_VALIDATE_URL)){
            if($data->photo){
                if (file_exists(public_path().'/assets/images/products/'.$data->photo)) {
                    unlink(public_path().'/assets/images/products/'.$data->photo);
                }
            }

        }

        if (file_exists(public_path().'/assets/images/thumbnails/'.$data->thumbnail) && $data->thumbnail != "") {
            unlink(public_path().'/assets/images/thumbnails/'.$data->thumbnail);
        }

        if($data->file != null){
            if (file_exists(public_path().'/assets/files/'.$data->file)) {
                unlink(public_path().'/assets/files/'.$data->file);
            }
        }
        $data->delete();
        //--- Redirect Section
        $msg = __('Product Deleted Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends

// PRODUCT DELETE ENDS
    }

    public function settingUpdate(Request $request)
    {
        //--- Logic Section
        $input = $request->all();
        $data = \App\Models\Generalsetting::findOrFail(1);

        if (!empty($request->product_page)) {
            $input['product_page'] = implode(',', $request->product_page);
        }
        else {
            $input['product_page'] = null;
        }

        if (!empty($request->wishlist_page)) {
            $input['wishlist_page'] = implode(',', $request->wishlist_page);
        }
        else {
            $input['wishlist_page'] = null;
        }

        cache()->forget('generalsettings');

        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    public function getAttributes(Request $request) {
      $model = '';
      if ($request->type == 'category') {
        $model = 'App\Models\Category';
      } elseif ($request->type == 'subcategory') {
        $model = 'App\Models\Subcategory';
      } elseif ($request->type == 'childcategory') {
        $model = 'App\Models\Childcategory';
      }

      $attributes = Attribute::where('attributable_id', $request->id)->where('attributable_type', $model)->get();
      $attrOptions = [];
      foreach ($attributes as $key => $attribute) {
        $options = AttributeOption::where('attribute_id', $attribute->id)->get();
        $attrOptions[] = ['attribute' => $attribute, 'options' => $options];
      }
      return response()->json($attrOptions);
    }
}
