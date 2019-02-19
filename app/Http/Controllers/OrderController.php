<?php

namespace App\Http\Controllers;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Repositories\CategoryRepository;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\StockRepository;
use Flash;
use Illuminate\Support\Facades\Auth;
use PDF;
use Response;
use View;

class OrderController extends AppBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;
    private $productRepository;
    private $orderItemRepository;
    private $stockRepository;
    private $categoryRepository;

    public function __construct(OrderRepository $orderRepo, ProductRepository $productRepo, OrderItemRepository $orderItemRepo, StockRepository $stockRepo, CategoryRepository $categoryRepo)
    {
        $this->orderRepository = $orderRepo;
        $this->productRepository = $productRepo;
        $this->orderItemRepository = $orderItemRepo;
        $this->stockRepository = $stockRepo;
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Order.
     *
     * @param OrderDataTable $orderDataTable
     * @return Response
     */
    public function index(OrderDataTable $orderDataTable)
    {
        $order = array();
        if (Auth::user()->type != 1){
            $order['new'] = Order::where('order_status', '0')
                        ->where('user_id',Auth::user()->type)
                        ->count();
            $order['receive'] = Order::where('order_status', '1')
                        ->where('user_id',Auth::user()->type)
                        ->count();
        }else{
            $order['new'] = Order::where('order_status', '0')->count();
            $order['receive'] = Order::where('order_status', '1')->count();
        }
      
        return $orderDataTable->render('orders.index', ['orders' => $order]);
    }

    /**
     * Show the form for creating a new Order.
     *
     * @return Response
     */
    public function create()
    {
        $category = $this->categoryRepository->all();

        return view('orders.create')->with(['category' => $category]);
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param CreateOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderRequest $request)
    {
        $input = $request->except('value');
        $input['user_id'] = Auth::user()->id;
        $input['order_status'] = 0;

        $order = $this->orderRepository->create($input);

        $order_item = $request->value;
        $item_value = array();
        if ($order) {

            foreach ($order_item as $key => $value) {
                // get product
                $product = $this->productRepository->findWithoutFail($key);
                $item_value['order_id'] = $order->id;
                $item_value['product_id'] = $product->id;
                $item_value['stock_id'] = $product->stock->id;
                $item_value['value'] = $value;
                $this->orderItemRepository->create($item_value);

                //update value stock
                $stock = $this->stockRepository->findWithoutFail($item_value['stock_id']);
                $input_stock = array();
                $input_stock['value'] = $stock->value - $item_value['value'];
                $stock = $this->stockRepository->update($input_stock, $item_value['stock_id']);
            }

        }

        Flash::success('Order saved successfully.');

        return redirect(route('orders.index'));
    }

    /**
     * Display the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $order = $this->orderRepository->with('item')->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        return view('orders.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);
        $category = $this->categoryRepository->all();
        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        // get item
        $item = array();
        foreach ($order->item as $key => $value) {
            $item[$value->product_id] = $value;
        }
        $order->value = $item;

        return view('orders.edit')->with(['order' => $order, 'category' => $category]);
    }

    /**
     * Update the specified Order in storage.
     *
     * @param  int              $id
     * @param UpdateOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderRequest $request)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $input = $request->except('value');

        $order_item = $request->value;
        $order = $this->orderRepository->update($input, $id);

        $item = array();
        foreach ($order->item as $key => $value) {
            $item[$value->product_id] = $value;
        }

        $item_value = array();
        if ($order) {
            foreach ($order_item as $key => $value) {
                // get product
                $product = $this->productRepository->findWithoutFail($key);
                $item_value['order_id'] = $order->id;
                $item_value['product_id'] = $product->id;
                $item_value['stock_id'] = $product->stock->id;
                $item_value['value'] = $value;
                if (!empty($item[$key])) {
                    $this->orderItemRepository->update($item_value, $item[$key]->id);

                    //update value stock
                    $stock = $this->stockRepository->findWithoutFail($item_value['stock_id']);
                    $input_stock = array();
                    $value = $item_value['value'] - $item[$product->id]->value;

                    $input_stock['value'] = abs($value - $stock->value);

                    $stock = $this->stockRepository->update($input_stock, $item_value['stock_id']);
                } else {
                    $this->orderItemRepository->create($item_value);

                    //update value stock
                    $stock = $this->stockRepository->findWithoutFail($item_value['stock_id']);
                    $input_stock = array();
                    $input_stock['value'] = $stock->value - $item_value['value'];
                    $stock = $this->stockRepository->update($input_stock, $item_value['stock_id']);
                }

            }

        }

        Flash::success('Order updated successfully.');

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified Order from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $this->orderRepository->delete($id);

        Flash::success('Order deleted successfully.');

        return redirect(route('orders.index'));
    }

    public function generatePdf($id)
    {
        $data = [];
        $order = $this->orderRepository->findWithoutFail($id);
        $data['order'] = $order;
        // $pages = array();
        // $pages[] = View::make('orderPdf1',$data);
        // $pages[] = View::make('orderPdf2',$data);

        // $pdf = PDF::loadView('orderPdf', ['pages' => $pages]);

        $pdf = PDF::loadView('orderPdf', $data);

        if ($pdf) {
            $input = [];
            $input['order_status'] = 1;
            $order = $this->orderRepository->update($input, $order->id);
        }
        // $pdf->setPaper('A4', 'portrait');
        // return $pdf->stream('invoice.pdf');

        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('orderPdf.pdf', array('Attachment' => 2));
        // return $pdf->download('hdtuto.pdf');
    }
}
