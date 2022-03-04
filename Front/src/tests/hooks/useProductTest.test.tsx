// __tests__/fetch.test.js
import React from "react";
import { rest } from "msw";
import { setupServer } from "msw/node";
import { render, waitFor, screen } from "@testing-library/react";
import { renderHook, act } from "@testing-library/react-hooks";
import "@testing-library/jest-dom";
import Product from "../../components/Product";
import useProduct from "../../hooks/useProduct";



const server = setupServer(
  rest.get(
    "https://rickandmortyapi.com/api/character/31",
    (req, res, ctx) => {
      return res(
        ctx.json({
          products: [
              { id: 1, name: 'Rick Sanchez', price: '15', quantity: 0, image: 'https://rickandmortyapi.com/api/character/avatar/1.jpeg' },
              { id: 3, name: 'Summer Smith', price: '26', quantity: 10, image: 'https://rickandmortyapi.com/api/character/avatar/3.jpeg' },
              { id: 15, name: 'Alien Rick', price: '65', quantity: 3, image: 'https://rickandmortyapi.com/api/character/avatar/15.jpeg' },
              { id: 16, name: 'Amish Cyborg', price: '10', quantity: 20, image: 'https://rickandmortyapi.com/api/character/avatar/16.jpeg' }
          ]
        })
      );
    }
  )
);

beforeAll(() => server.listen());
afterEach(() => server.resetHandlers());
afterAll(() => server.close());

test("load rick & morty mock", async () => {
  const { container } = render(<Product setRoute={"product"} />);
  await waitFor(() => screen.getByText(/Détail/i));
  expect(container.getElementsByTagName("img").length).toBe(1);
  expect(container.getElementsByTagName("p").length).toBe(2);
});

