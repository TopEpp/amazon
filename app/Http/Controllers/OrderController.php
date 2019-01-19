<?php

namespace App\Http\Controllers;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class OrderController extends AppBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;
    private $productRepository;
    private $orderItemRepository;

    public function __construct(OrderRepository $orderRepo, ProductRepository $productRepo, OrderItemRepository $orderItemRepo)
    {
        $this->orderRepository = $orderRepo;
        $this->productRepository = $productRepo;
        $this->orderItemRepository = $orderItemRepo;
    }

    /**
     * Display a listing of the Order.
     *
     * @param OrderDataTable $orderDataTable
     * @return Response
     */
    public function index(OrderDataTable $orderDataTable)
    {
        return $orderDataTable->render('orders.index');
    }

    /**
     * Show the form for creating a new Order.
     *
     * @return Response
     */
    public function create()
    {
        $product = $this->productRepository->all();
        return view('orders.create')->with('product', $product);
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
        $product = $this->productRepository->all();
        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        // get item
        $item = array();
        foreach ($order->item as $key => $value) {
            $item[$value->id] = $value;
        }
        $order->value = $item;

        return view('orders.edit')->with(['order' => $order, 'product' => $product]);
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
            $item[$value->id] = $value;
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
                } else {
                    $this->orderItemRepository->create($item_value);
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
}
