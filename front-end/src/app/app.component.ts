import { Component, inject } from '@angular/core';
import { ProductsService } from './services/products.service';
import { AsyncPipe, CurrencyPipe, NgIf } from '@angular/common';
import { ProductComponent } from './products/product/product.component';
import { RouterOutlet } from '@angular/router';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrl: './app.component.css',
  imports: [NgIf, AsyncPipe, CurrencyPipe, ProductComponent, RouterOutlet],
  
})
export class AppComponent {
  title = 'front-end';
  private _productService = inject(ProductsService);

  products$ = this._productService.getAll();
}
