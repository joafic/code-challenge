import { Routes } from '@angular/router';
import { ProductComponent } from './products/product/product.component';
import { ProductDetailComponent } from './products/product/product-detail.component';

export const routes: Routes = [
    {path: '', redirectTo: 'products', pathMatch: "full"},
    {path: 'products', component: ProductComponent},
    {path: 'product/:id', component: ProductDetailComponent}
  ];
