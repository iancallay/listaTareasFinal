import { ComponentFixture, TestBed } from '@angular/core/testing';
import { CreartareaPage } from './creartarea.page';

describe('CreartareaPage', () => {
  let component: CreartareaPage;
  let fixture: ComponentFixture<CreartareaPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(CreartareaPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
