import React, { useEffect, useState } from "react";
import { endpoint, Product } from "../App";
import useCart from "../hooks/useCart";

const Cart = ({ setRoute }: { setRoute: (data: any) => void }) => {
    const { loading, products, message, loadCart, removeToCart } = useCart();

    return (
        <div>
            {loading && <div>Loading....</div>}
            {message && <p>{message}</p>}
            <div onClick={() => setRoute({ route: "home" })}>Retour</div>
            <div>
                {products.map((product) => {
                return (
                    <React.Fragment>
                        <div><h2>Panier</h2></div>
                        <div>
                            <img src={product.image} alt="" />
                            <p>Figurine de {product.name}</p>
                            <p>Quantité {product.quantity}</p>
                        </div>
                        <button onClick={() => removeToCart(product)}>
                            Supprimer du panier
                        </button>
                        <hr />
                    </React.Fragment>
                );
                })}
            </div>
        </div>
    );
}

export default Cart;