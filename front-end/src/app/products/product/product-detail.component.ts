import { Component } from '@angular/core';
import { inject } from '@angular/core';
import { Product } from '../../models/products.model';
import {AsyncPipe, CurrencyPipe, NgIf } from '@angular/common';
import { ProductsService } from '../../services/products.service';
import { ActivatedRoute, Router } from '@angular/router';
@Component({
  selector: 'app-product',
  imports: [NgIf, AsyncPipe, CurrencyPipe],
  template: `
      <div>
        @let product = (product$ | async);
        <div>{{product?.name}}</div>
        <span><b>Description:</b> {{product?.description}}</span>
        <br>
        <span><b>Price: </b>{{product?.price | currency}}</span>
        <br>
        <button *ngIf="product?.id !== 1" (click)="remove()">Delete</button>
      </div>
  `
})
export class ProductDetailComponent {
  private _productService = inject(ProductsService);
  private route = inject(ActivatedRoute);
  private router = inject(Router);

  id = this.route.snapshot.paramMap.get('id');

  product$ = this._productService.getById(Number(this.id));

  remove(){
    this._productService.delete(Number(this.id)).subscribe({
      next: () => {
        console.log('Deleted!');
        this.router.navigate(['/products'])
      },
      error: (err) => console.error(err)
    });
  }
}
