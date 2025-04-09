import { Component } from '@angular/core';
import {inject} from '@angular/core';
import {AsyncPipe } from '@angular/common';
import { ProductsService } from '../../services/products.service';
import { RouterLink } from '@angular/router';
@Component({
  selector: 'app-product',
  imports: [AsyncPipe, RouterLink],
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
