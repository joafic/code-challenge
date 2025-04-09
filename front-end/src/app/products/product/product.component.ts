import { Component } from '@angular/core';
import {computed, effect, inject, Injectable, signal, Signal, input} from '@angular/core';
import { Product } from '../../models/products.model';
import {AsyncPipe, CurrencyPipe, NgIf } from '@angular/common';
import { ProductsService } from '../../services/products.service';
import { RouterLink } from '@angular/router';
@Component({
  selector: 'app-product',
  imports: [NgIf, AsyncPipe, CurrencyPipe, RouterLink],
  template: `
    @for (product of (products$ | async); track product.id) {
      <div style="margin-bottom: 1rem;">
        <div>{{product.name}}
          <button [routerLink]="['/product', product.id]">Details</button>
        </div>
      </div>
    }
  `
})
export class ProductComponent {
  private _productService = inject(ProductsService);
  
  products$ = this._productService.getAll();
}
