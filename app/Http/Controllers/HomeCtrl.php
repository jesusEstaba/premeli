<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\Product;
use App\models\References;
use Auth;

class HomeCtrl extends Controller
{
    public function index()
    {
        $products = Product::where('user', Auth::user()->id)
            ->select('id', 'numProduct', 'price', 'title', 'thumbnail')
            ->get();
        
        foreach ($products as $key => $prod) {
            $prod->status = '';
            
            $references = \DB::table('references')->where('product', $prod->id)
                ->select('numProcRef', 'price', 'id')
                ->orderBy('numProcRef')
                ->get();

            $arrayIds = $this->arrayAttr($references, 'numProcRef');

            $items =$this->meliItems(
                $arrayIds,
                ['price', 'id', 'title'],
                'price'
            );

            foreach ($references as $keyA => $valueA) {
                foreach ($items as $keyB => $valueB) {
                    if ($valueA->numProcRef == $valueB->id) {
                        $valueA->title = $valueB->title;

                        if ($valueA->price != $valueB->price) {
                            $valueA->price2 = $valueB->price;
                            
                            $diff = (($valueA->price - $valueB->price)/$valueA->price) * 100;

                            $valueA->diff = round($diff, 2)*-1;

                            $valueA->color = ($valueA->diff>0) ? 'green' : 'red';

                            unset($keyB);
                            
                            $prod->status = ' yellow lighten-2 prodChange';
                        }
                    }
                }
            }

            $prod->references = $references;
        }

        return view('home')->with([
            'products' => $products,
        ]);
    }


    public function viewAdd()
    {
        $products = Product::where('user', Auth::user()->id)->get();
        return view('add-product')->with([
            'products' => $products,
        ]);
    }

    public function viewRefProc($id)
    {
        //$products = Product::where('user', Auth::user()->id)->get();
        
        return view('add-ref-product')->with([
            'product' => $this->meliItem($id, [
                'id',
                'title',
                'price',
            ])
        ]);
    }


    public function saveProduct(Request $request)
    {
        $procExist = Product::where('numProduct', $request['productId'])
            ->where('user', Auth::user()->id)
            ->first();
        
        if ($procExist) {
            $res = "exist";
        } else {
            $item = $this->meliItem($request['productId'], [
                'price',
                'title',
                'thumbnail',
            ]);
            
            if ($item) {
                $product = Product::create([
                    'user' => Auth::user()->id,
                    'price' => $item->price,
                    'numProduct' => $request['productId'],
                    'title' => $item->title,
                    'thumbnail' => $item->thumbnail,
                ]);

                foreach ($request['references'] as $key => $value) {
                    $price = $this->meliItem($value, [
                        'price',
                    ]);

                    if ($price) {
                        $ref = References::create([
                            'product' => $product->id,
                            'numProcRef' => $value,
                            'price' => $price->price,
                        ]);
                    }
                }

                $res = "added";
            } else {
                $res = "not found";
            }
        }

        return response()->json(['status'=> $res]);
    }


    protected function meliItem($id, array $attr)
    {
        if ($attrConv = $this->arrayAttr($attr)) {
            $attrConv = '?attributes=' . $attrConv;
        } else {
            $attrConv = '';
        }

        $url = 'https://api.mercadolibre.com/items/' . $id . $attrConv;
        
        return $this->jsonRequest($url);
    }

    protected function meliItems($ids, $attr = [], $order = '')
    {
        if ($attrConv = $this->arrayAttr($attr)) {
            $attrConv = '&attributes=' . $attrConv;
        } else {
            $attrConv = '';
        }
        
        $order = ($order) ?'&order=' . $order : '';

        $url = 'https://api.mercadolibre.com/items?ids=' . $ids . $attrConv . $order;

        return $this->jsonRequest($url);
    }

    protected function arrayAttr(array $attr, $prop = '')
    {
        $listAttr = '';

        foreach ($attr as $key => $val) {
            if ($prop) {
                $val = $val->{$prop};
            }

            $listAttr .= ($listAttr=='') ? $val : ','.$val;
        }

        return $listAttr;
    }

    protected function jsonRequest($url)
    {
        $cont = @file_get_contents($url);
        if ($cont) {
            $jsonCont = json_decode($cont);
            if ($jsonCont) {
                return $jsonCont;
            }
        }
        
        return false;
    }


    protected function comparePriceRef(array $ids)
    {
        foreach ($variable as $key => $value) {
            # code...
        }
        $item = $this->meliItems($id, ['price']);

        if ($item->price != $price) {
            return $item->price;
        }

        return false;
    }
}
