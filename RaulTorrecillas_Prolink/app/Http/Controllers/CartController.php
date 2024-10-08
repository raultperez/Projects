<?php

namespace App\Http\Controllers;

use App\Mail\OrderInvoiceMail;
use App\Models\Cart;
use App\Models\Cart_proposal;
use App\Models\Order;
use App\Models\Order_proposal;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function list(){

        $company = auth()->user()->company;

        $cart = $company->cart;

        $addedProposals = Cart_proposal::query()->where('cart_id',$cart->id)->get();

        $total = 0;

        foreach ($addedProposals as $proposal){
            $total += $proposal->n_hours * $proposal->price;
        }

        return view('Cart.cart',[
            'addedProposals' => $addedProposals,
            'cart' => $cart,
            'total' => $total
        ]);
    }

    public function add($id) {
        // Validar la entrada para asegurarse de que 'hours' es requerido y numérico
        $validatedData = request()->validate([
            'hours' => ['required', 'numeric','min:0']
        ]);

        // Obtener la propuesta específica por ID
        $proposal = Proposal::findOrFail($id);

        // Obtener el carrito asociado a la compañía del usuario autenticado
        $cart = Cart::where('company_id', auth()->user()->company->id)->first();

        // Asegurarse de que se encontró un carrito antes de continuar
        if (!$cart) {
            return redirect('/proposals')->with('message', 'No se encontró un carrito para la empresa.');
        }

        if (Cart_proposal::where('proposal_id',$id)->where('cart_id',$cart->id)->first()){
            $cartProposal = Cart_proposal::where('proposal_id',$id)->first();

            $cartProposal->n_hours = $cartProposal->n_hours + $validatedData['hours'];

            $cartProposal->save();
        } else {
            // Crear la entrada en la tabla 'Cart_proposal'
            Cart_proposal::create([
                'n_hours' => $validatedData['hours'], // Pasar el valor numérico validado de horas
                'price' => $proposal->price_hour,
                'cart_id' => $cart->id,
                'proposal_id' => $proposal->id
            ]);
        }

        // Redirigir con un mensaje de éxito
        return redirect('/cart')->with('message', 'Oferta añadida correctamente');
    }

    public function increase($id){
        $cartProposal = Cart_proposal::findOrFail($id);

        $cartProposal->n_hours = $cartProposal->n_hours + 1;

        $cartProposal->save();

        return redirect()->back();
    }

    public function decrease($id){
        $cartProposal = Cart_proposal::findOrFail($id);

        $cartProposal->n_hours = $cartProposal->n_hours - 1;

        if ($cartProposal->n_hours <= 0){
            $cartProposal->delete();
            return redirect()->back();
        }

        $cartProposal->save();
        return redirect()->back();
    }

    public function order($cart_id) {
        // Almacenar datos en el order
        $orderData = [
            'total' => request()->input('total'),
            'cart_id' => $cart_id
        ];

        $newOrder = Order::create($orderData);

        // Buscar todas las relaciones en Cart_proposal con el cart_id proporcionado
        $cartProposals = Cart_proposal::where('cart_id', $cart_id)->get();

        // Variables para calcular totales
        $totalPrice = 0;
        $totalHours = 0;
        $orderDetails = [];

        foreach ($cartProposals as $proposal) {
            $price = $proposal->price;
            $n_hours = $proposal->n_hours;

            // Acumular los totales
            $totalPrice += $price;
            $totalHours += $n_hours;

            // Guardar cada propuesta en el pedido
            Order_proposal::create([
                'order_id' => $newOrder->id,
                'proposal_id' => $proposal->proposal_id,
                'n_hours' => $n_hours,
                'price' => $price
            ]);

            // Recopilar detalles para la factura
            $orderDetails[] = [
                'proposal_name' => $proposal->proposal->name,
                'n_hours' => $n_hours,
                'price' => $price
            ];
        }

        // Actualizar el pedido con los totales calculados
        $newOrder->update([
            'total_price' => $totalPrice,
            'total_hours' => $totalHours
        ]);

        // Mandar mail al usuario
        $user = auth()->user();
        $details = [
            'title' => 'Detalles de tu pedido',
            'orderDetails' => $orderDetails,
            'totalPrice' => $totalPrice,
            'totalHours' => $totalHours,
            'userName' => $user->name
        ];

        Mail::to($user->email)->send(new OrderInvoiceMail($details));

        // Eliminar el contenido del carrito
        Cart_proposal::where('cart_id', $cart_id)->delete();

        return redirect('/')->with('message', 'Pedido realizado, revise su correo');
    }


}
